<?php

require 'vendor/autoload.php';

if( !class_exists("ZoteroController")) {
    class ZoteroController {

        /**
         * The api key.
         *
         * @var string
         */
        private $apiKey;

        /**
         * The group id.
         *
         * @var int
         */
        private $groupKey;

        /**
         * The api object.
         *
         * @var \Hedii\ZoteroApi\ZoteroApi
         */
        private $apiObject;

        /**
         * The array storing the Bibliography
         * @var array
         */
        private array $bibArray;

        /**
         * ZoteroController constructor.
         * @param $apiKey
         * @param $groupID
         */
        public function __construct($apiKey, $groupID)
        {
            $this -> apiKey = $apiKey;
            $this -> groupKey = $groupID;
            $this -> apiObject = new Hedii\ZoteroApi\ZoteroApi($this->apiKey);
            $this -> bibArray = [];
            /*add_action( 'zoteroCronJob', 'getAllItems' );
            if ( ! wp_next_scheduled( 'zoteroCronJob' ) ) {
                wp_schedule_event( time(), 'daily', 'zoteroCronJob' );
            }*/
            add_action('init', array($this, 'AddThisPage'));
        }

        function AddThisPage() {
            $page = array(
                'page_template' => 'exampletemplate.php', //Sets the template for the page.
                'post_title' => '03-25', //The title of your post.
                'post_status' => 'publish',
                'post_type' => 'page'
            );

            $page_exists = get_page_by_title( $page['post_title'] );
           //echo $page_exists->ID;
            if( $page_exists == null ) {
                // Page doesn't exist, so lets add it
                $insert = wp_insert_post( $page );
                if( $insert ) {
                    // Page was inserted ($insert = new page's ID)
                }
            } else {
                // Page already exists
            }
        }

        /**
         * Deletes all of the media.txt files. Called in GetAllItems
         */
        function deleteMediaFiles(){
            $directoryPath = dirname(__FILE__, 2) . "/public/";

            $di = new RecursiveDirectoryIterator($directoryPath);
            foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
                if(strcmp($file->getFilename(),"media.txt") == 0){
                    $name = $file->getPath() . "/" . $file->getFilename();
                    $file = null;
                    unlink($name);
                }
            }
        }

        /**
         * Gets all top level items in Zotero Database
         */
        public function getAllItems() {
            $this->deleteMediaFiles();
            $response = $this->apiObject->group($this->groupKey)->items()->top()->limit(100)->send();
            $items = json_decode($response->getJson(), false);


            foreach($items as $item) {
                //var_dump($item->key);
                $this->getItem($item->key);
            }
            $this->createBib();
        }

        /**
         * Get an item from Zotero DB
         * @param $itemKey
         */
        public function getItem($itemKey)
        {
            //$response = $this->apiObject->group($this->groupKey)->items($itemKey)->send();
            $response = $this->apiObject->group($this->groupKey)->items($itemKey)->include('data,bib')->send();

            $item = json_decode($response->getJson(), false);
            //$this -> writeDataToFile("datadump".$itemKey.".json", $response->getJson());

            if ($item->data->extra != "") {
                $this->makedir(dirname(__FILE__, 2)."/public/", $item->data->extra);
                array_push($this->bibArray, $item->bib);
                if ($item->meta->numChildren > 0 && isset($item->links->attachment)) {
                    $childResponse = $this->apiObject->group($this->groupKey)->items($itemKey)->children()->send();
                    $children = json_decode($childResponse->getJson(), false);
                    //$this -> writeDataToFile("datadump".$itemKey.".json", $childResponse->getJson());

                    $this->makedir(dirname(__FILE__, 2) . "/public/".$item->data->extra."/", $itemKey);
                    foreach ($children as $child) {
                        if ($child->data->itemType == 'attachment') {
                            $attachmentKey = $child->key;
                            $useDate = $item->data->extra;
                           // if ($attachmentKey == 'RHKF7VK4')$this -> writeDataToFile("datadump".$attachmentKey.".json", $childResponse->getJson());
                            if (isset($child->data->filename)) {
                                $this->getAttachment($itemKey, $attachmentKey, $useDate);
                                $attachmentFilename = $this->getAttachmentFilename($attachmentKey);
                                //We should ensure that we did get an attachment before doing this. Maybe return true from "getAttachment"
                                $this->addAttachmentIframe($itemKey, $attachmentKey, $useDate, $attachmentFilename, True);
                            } else {
                                $this->addAttachmentIframe($itemKey, $attachmentKey, $useDate, $child->data->url, False);
                            }
                        }
                    }
                }
                elseif (isset($item->data->url)) {
                    //fix
                }
                if (isset($item->bib)) {
                    //$this->makedir(dirname(__FILE__, 2) . "/public/".$item->data->extra."/", $itemKey);
                    $itemBib = $item->bib;
                    $useDate = $item->data->extra;
                    $this->addItemBib($itemBib, $useDate);
                }
            }
        }

        /**
         * adds a bibliography for an item in the database to bib.txt under its usedate directory
         *
         * @param $itemBib
         * @param $useDate
         */
        public function addItemBib($itemBib, $useDate)
        {
            $textFile = dirname(__FILE__, 2) . "/public/". $useDate . "/" . "bib.txt";
            file_put_contents ($textFile, $itemBib, FILE_APPEND);
        }

        /**
         * adds every item to the full bibliography file
         *
         * @param $itemBib
         */
        public function createBib() {
            $textFile = dirname(__FILE__, 2) . "/public/fullBib.txt";
            sort($this->bibArray);
            foreach($this->bibArray as $value) {
                file_put_contents($textFile, $value . PHP_EOL . PHP_EOL, FILE_APPEND);
            }
        }



        /**
         * Creates Iframe for an Attachment and appends to Media file for correct use date.
         * @param $itemKey
         * @param $attachmentKey
         * @param $useDate
         * @param $attachmentFilename
         * @param $isFile
         */
        public function addAttachmentIframe($itemKey, $attachmentKey, $useDate, $attachmentFilename, $isFile){
            $theFilePath = dirname(__FILE__, 2) . "/public/". $useDate . "/";
            $firstPartURIPath = explode('/', $_SERVER['REQUEST_URI'])[1];
            //Todo this will have to change to https on the real server.
            $htmlAttachmentLink = 'http://' . "$_SERVER[HTTP_HOST]" . '/' . $firstPartURIPath .  "/wp-content/plugins/zotpull/public/". $useDate ."/".$itemKey."/".$attachmentKey . "/" . $attachmentFilename;
            $attachmentlink = 'https://f9c91f0e9264.ngrok.io/' . $firstPartURIPath .  "/wp-content/plugins/zotpull/public/". $useDate ."/".$itemKey."/".$attachmentKey . "/" . $attachmentFilename . '&embedded=true';
            $supported_image = array(
                'gif',
                'jpg',
                'jpeg',
                'png'
            );
            $ext = strtolower(pathinfo($attachmentFilename, PATHINFO_EXTENSION));
            //If image, use img.
            if (in_array($ext, $supported_image)) {
                $theFile = $theFilePath . "images.txt";
                $text =  $htmlAttachmentLink . "\n";
                file_put_contents ($theFile, $text, FILE_APPEND);
            }
            else if(strcmp($ext,"mp4")==0) {
                $theFile = $theFilePath . "videos.txt";
                $text = $htmlAttachmentLink . "\n";
                file_put_contents($theFile, $text, FILE_APPEND);
            }
           else if (strcmp($ext,"html")==0){
               //$objectHtml =  '<a href="' . $htmlAttachmentLink . '"  >' . $attachmentFilename . '</a> <iframe src="' . $htmlAttachmentLink . '"  width="500" height="600">Not supported</iframe><br>';
               $theFile = $theFilePath . "snapshots.txt";
               $text = $htmlAttachmentLink . "\n";
               file_put_contents ($theFile, $text, FILE_APPEND);
           }
           else if(strcmp($ext,"mp3") == 0 ){
               //$objectHtml = '<figure><figcaption>' . $attachmentFilename .'</figcaption><audio controls src="' . $htmlAttachmentLink . '"> Your browser does not support the <code>audio</code> element.</audio> </figure>';
               $theFile = $theFilePath . "audios.txt";
               $text = $htmlAttachmentLink . "\n";
               file_put_contents ($theFile, $text, FILE_APPEND);
           }
           else if($isFile == False){
               //$objectHtml =  '<a href="' . $attachmentFilename . '"  >' . $attachmentFilename . '</a> <iframe src="' . $attachmentFilename . '"  width="500" height="600">Not supported</iframe><br>';
               $theFile = $theFilePath . "docs.txt";
               $text = $attachmentFilename . "\n";
               file_put_contents ($theFile, $text, FILE_APPEND);
           }
           else{
               //$objectHtml =  '<a href="' . $attachmentlink . '"  target="_top">' . $attachmentFilename . '</a> <iframe src="https://docs.google.com/gview?url=' . $attachmentlink . '"  width=100% height=100%>Not supported</iframe> <br>' ;
               $theFile = $theFilePath . "gviewdocs.txt";
               $text = "https://docs.google.com/gview?url=' . $attachmentlink . '" . "\n";
               file_put_contents ($theFile, $text, FILE_APPEND);
            }
        }

        /**
         * Get filename of attachment
         *
         * @param string $attachmentKey
         * @return string $name
         */
        public function getAttachmentFilename($attachmentKey){
            $response = $this->apiObject->group($this->groupKey)->items($attachmentKey)->send();
            $attachment = json_decode($response->getJson(), false);
            $name = $attachment->data->filename;
            return $name;
        }

        /**
         * Get attachment from key
         *
         * @param string $itemkey
         * @param string $attachmentKey
         * @param string $useDate
         */
        public function getAttachment($itemKey, $attachmentKey, $useDate)
        {

            $filepath = dirname(__FILE__, 2)."/resources/temp/".$attachmentKey.".zip";
            $filename = $this->getAttachmentFilename($attachmentKey);
            $response = $this->apiObject->group($this->groupKey)->items($attachmentKey."/file")->send();



            // Put attachment into zip file depending on file type
            if (substr_compare($filename, '.html', -5) === 0) {
                if (strpos($response->getJson(), '<!DOCTYPE html') === 0) {
                    $zip = new ZipArchive;
                    if ($zip->open($filepath, ZipArchive::CREATE) === TRUE)
                    {
                        $zip->addFromString($filename, $response->getJson());
                        $zip->close();
                    }
                } else {
                    $this -> writeDataToFile($attachmentKey.".zip", $response->getJson());
                }
            } else {
                $zip = new ZipArchive;
                if ($zip->open($filepath, ZipArchive::CREATE) === TRUE)
                {
                    $zip->addFromString($filename, $response->getJson());
                    $zip->close();
                }
            }

            $zip = new ZipArchive();
            $res = $zip->open($filepath);
            if ($res === TRUE) {
                $this->makedir(dirname(__FILE__, 2) . "/public/".$useDate."/".$itemKey."/", $attachmentKey);
                $zip->extractTo(dirname(__FILE__, 2) . "/public/".$useDate."/".$itemKey."/".$attachmentKey);
                $zip->close();
            }
        }

        /**
         * Creates a new directory at the specified path
         *
         * @param string $path
         * @param string $directory
         */
        function makedir($path, $directory)
        {
            if (!is_dir($path."/".$directory) && !is_writable($path."/".$directory)) {
                mkdir($path . "/" . $directory, 0777, true);
            }
        }

        /**
         * Writes Data in the form of an Object to a File
         *
         * @param string $fileName
         * @param string $objectToWrite
         */
        function writeDataToFile($fileName, $objectToWrite)
        {
            $fileName = dirname(__FILE__, 2) . "/resources/temp/" . $fileName;
            $fp = fopen($fileName, 'wb');
            fwrite($fp, $objectToWrite);
            fclose($fp);
        }

    }
}