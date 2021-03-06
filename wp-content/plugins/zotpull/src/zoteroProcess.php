<?php
require 'vendor/autoload.php';
require 'screenshotlayer.php';

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
        }

       
        /**
         * Deletes all of the media.txt files. Called in GetAllItems
         */
        function deleteMediaFiles(){
            $directoryPath = dirname(__FILE__, 2) . "/public/";
            $mediaFiles = array(
                'images.txt',
                'snapshots.txt',
                'gviewdocs.txt',
                'videos.txt',
                'audios.txt',
                'manuscripts.txt',
                'links.txt'
            );
            $di = new RecursiveDirectoryIterator($directoryPath);
            foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
                if(in_array($file->getFilename(),$mediaFiles)){
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

            $i = 0;
            $limit = 100;
            while(($response = $this->apiObject->group($this->groupKey)->items()->top()->start($i)->limit($limit)->send())->getJson() != "[]") {
                echo $i . "\n";
                $items = json_decode($response->getJson(), false);

                $fileString = file_get_contents(dirname(__FILE__, 2) . "/resources/items.txt");

                if (empty($fileString)) $this->deleteMediaFiles();

                foreach ($items as $item) {
                    $attempts = 2;
                    if (empty($fileString)) {
                        while(true) {
                            try {
                                $this->getItem($item->key);
                                break;
                            } catch (Exception $e) {
                                if (--$attempts < 1) throw $e;
                            }
                        }
                        file_put_contents(dirname(__FILE__, 2) . "/resources/items.txt", $item->key . "\n", FILE_APPEND);
                    } else {
                        if (strpos($fileString, $item->key) === false) {
                            while(true) {
                                try {
                                    $this->getItem($item->key);
                                    break;
                                } catch (Exception $e) {
                                    if (--$attempts < 1) throw $e;
                                }
                            }
                            file_put_contents(dirname(__FILE__, 2) . "/resources/items.txt", $item->key . "\n", FILE_APPEND);
                        }
                    }
                }
                $this->createBib();
                $i += $limit;
            }
        }

        /**
         * Get an item from Zotero DB
         * @param $itemKey
         */
        public function getItem($itemKey)
        {
            echo "  " . $itemKey . "\n";
            $isManuscript = false;
            $response = $this->apiObject->group($this->groupKey)->items($itemKey)->include('data,bib')->send();

            $item = json_decode($response->getJson(), false);
            if (isset($item->data->manuscriptType)) {
                if($item->data->manuscriptType == "Bonus Content"){
                    $isManuscript = true;
                }
            }
            if (preg_match("~^\d{4}/\d{2}/\d{2}$~", $item->data->extra)) {
                $this->makedir(dirname(__FILE__, 2)."/public/", $item->data->extra);
                array_push($this->bibArray, $item->bib);

                if ($item->meta->numChildren > 0 && isset($item->links->attachment)) {
                    $childResponse = $this->apiObject->group($this->groupKey)->items($itemKey)->children()->send();
                    $children = json_decode($childResponse->getJson(), false);

                    $this->makedir(dirname(__FILE__, 2) . "/public/".$item->data->extra."/", $itemKey);
                    foreach ($children as $child) {
                        if ($child->data->itemType == 'attachment') {
                            $attachmentKey = $child->key;
                            $useDate = $item->data->extra;
                            if (isset($child->data->filename)) {
                                if ($this->getAttachment($itemKey, $attachmentKey, $useDate) == -1) {
                                    file_put_contents(dirname(__FILE__, 2) . "/resources/failed.txt", $item->key . "~d~" . $attachmentKey . "\n", FILE_APPEND);
                                    break;
                                }
                                $attachmentFilename = $this->getAttachmentFilename($attachmentKey);
                                if($isManuscript == true){
                                    $this->generateManuscriptLink($itemKey, $attachmentKey, $useDate, $item->bib, $item->data->title, $attachmentFilename);
                                }
                                else $this->generateMediaLinks($itemKey, $attachmentKey, $useDate, $item->bib, $item->data->title, $attachmentFilename, True);
                            } else {
                                $this->generateMediaLinks($itemKey, $attachmentKey, $useDate, $item->bib, $item->data->title, $child->data->url, False);
                            }
                        }
                    }
                }
                elseif (!empty($item->data->url)) {
                    $this->generateLiveLink($item->data->extra, $item->bib, $item->data->url);
                }
                if (isset($item->bib)) {
                    $this->addItemBib($item->bib, $item->data->extra);
                }

                if (($item->meta->numChildren > 0 && isset($item->links->attachment)) || (!empty($item->data->url))) {
                    $fileName = dirname(__FILE__, 2) . "/resources/temp/" . "useData.txt";
                    $fileString = file_get_contents($fileName);
                    if (strpos($fileString, $item->key) === false)
                        file_put_contents($fileName, $item->data->extra."\n", FILE_APPEND);
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

        public function generateLiveLink($useDate, $itemBib, $itemLink) {
            $theFilePath = dirname(__FILE__, 2) . "/public/". $useDate . "/";
            $bibString = trim(strip_tags($itemBib));
            $theFile = $theFilePath . "links.txt";
            $text = $itemLink . "~d~" . $bibString . "\n";
            file_put_contents ($theFile, $text, FILE_APPEND);
        }

        public function generateManuscriptLink($itemKey, $attachmentKey, $useDate, $itemBib, $itemTitle, $attachmentFilename){
            $theFilePath = dirname(__FILE__, 2) . "/public/". $useDate . "/";
            $htmlAttachmentLink = "http://localhost/pandemicjournal/wp-content/plugins/zotpull/public/". $useDate ."/".$itemKey."/".$attachmentKey . "/" . $attachmentFilename;
            $bibString = trim(strip_tags($itemBib));
            $theFile = $theFilePath . "manuscripts.txt";
            $text = $htmlAttachmentLink . "~d~" . $bibString . "~d~" . $itemTitle . "\n";
            file_put_contents ($theFile, $text, FILE_APPEND);
        }

        /**
         * Gets jpg screenshot of web source and saves to directory of attachment
         * @param $link
         * @param $filepath
         *
         */
        public function takeWebScreenshot($link, $filepath){
            $call = screenshotLayer($link);
            $screenshot = file_get_contents($call);
            if (!file_exists($filepath)) {
                mkdir($filepath, 0777, true);
            }
            $fullFilePath = $filepath . "screenshot.png";
            $screenshotFile = fopen($fullFilePath, "w") or die("Unable to open file for website screenshot!");
            fwrite($screenshotFile, $screenshot);
            fclose($screenshotFile);
        }

        /**
         * Creates Iframe for an Attachment and appends to Media file for correct use date.
         * @param $itemKey
         * @param $attachmentKey
         * @param $useDate
         * @param $attachmentFilename
         * @param $itemBib
         * @param $itemTitle
         * @param $isFile
         */
        public function generateMediaLinks($itemKey, $attachmentKey, $useDate, $itemBib, $itemTitle, $attachmentFilename, $isFile){
            $theFilePath = dirname(__FILE__, 2) . "/public/". $useDate . "/";
            //$firstPartURIPath = explode('/', $_SERVER['REQUEST_URI'])[1];
            //Todo this will have to change to https on the real server./public/".$useDate."/".$itemKey."/".$attachmentKey
            $attachmentFilePath = $theFilePath . $itemKey."/".$attachmentKey . "/";
            $path = "http://localhost/pandemicjournal/" .  "wp-content/plugins/zotpull/public/" . $useDate ."/".$itemKey."/".$attachmentKey . "/";
            $htmlAttachmentLink =  $path . $attachmentFilename;
            $screenshotLink = $path . "screenshot.png";
            //$htmlAttachmentLink = 'http://' . "$_SERVER[SERVER_NAME]" . '/' . 'pandemicjournal' .  "/wp-content/plugins/zotpull/public/". $useDate ."/".$itemKey."/".$attachmentKey . "/" . $attachmentFilename;
            $attachmentlink = 'https://adhc.lib.ua.edu/pandemicbook' .  "/wp-content/plugins/zotpull/public/". $useDate ."/".$itemKey."/".$attachmentKey . "/" . $attachmentFilename . '&embedded=true';
            $supported_image = array(
                'gif',
                'jpg',
                'jpeg',
                'png'
            );
            $ext = strtolower(pathinfo($attachmentFilename, PATHINFO_EXTENSION));

            $bibString = trim(strip_tags($itemBib));

            //If image, use img.
            if (in_array($ext, $supported_image)) {
                $theFile = $theFilePath . "images.txt";
                $text =  $htmlAttachmentLink . "~d~" . $bibString . "~d~" . $itemTitle . "\n";
                file_put_contents ($theFile, $text, FILE_APPEND);
            }
            else if(strcmp($ext,"mp4")==0) {
                $theFile = $theFilePath . "videos.txt";
                $text =  $htmlAttachmentLink . "~d~" . $bibString . "~d~" . $itemTitle . "\n";
                file_put_contents($theFile, $text, FILE_APPEND);
            }

           else if (strcmp($ext,"html")==0){
               //$objectHtml =  '<a href="' . $htmlAttachmentLink . '"  >' . $attachmentFilename . '</a> <iframe src="' . $htmlAttachmentLink . '"  width="500" height="600">Not supported</iframe><br>';
               $theFile = $theFilePath . "snapshots.txt";
               $this->takeWebScreenshot($htmlAttachmentLink, $attachmentFilePath);
               $text =  $htmlAttachmentLink . "~d~" . $bibString . "~d~" . $itemTitle . "~d~". $screenshotLink .  "\n";
               file_put_contents ($theFile, $text, FILE_APPEND);
           }
           else if(strcmp($ext,"mp3") == 0 ){
               //$objectHtml = '<figure><figcaption>' . $attachmentFilename .'</figcaption><audio controls src="' . $htmlAttachmentLink . '"> Your browser does not support the <code>audio</code> element.</audio> </figure>';
               $theFile = $theFilePath . "audios.txt";
               $text =  $htmlAttachmentLink . "~d~" . $bibString . "~d~" . $itemTitle . "\n";
               file_put_contents ($theFile, $text, FILE_APPEND);
           }
           else if($isFile == False){
               //$objectHtml =  '<a href="' . $attachmentFilename . '"  >' . $attachmentFilename . '</a> <iframe src="' . $attachmentFilename . '"  width="500" height="600">Not supported</iframe><br>';
               $theFile = $theFilePath . "snapshots.txt";
               $this->takeWebScreenshot($attachmentFilename, $attachmentFilePath);
               $text = $attachmentFilename . "~d~" . $bibString . "~d~" . $itemTitle . "~d~". $screenshotLink .  "\n";
               file_put_contents ($theFile, $text, FILE_APPEND);
           }
           else{
               //$objectHtml =  '<a href="' . $attachmentlink . '"  target="_top">' . $attachmentFilename . '</a> <iframe src="https://docs.google.com/gview?url=' . $attachmentlink . '"  width=100% height=100%>Not supported</iframe> <br>' ;
               $theFile = $theFilePath . "gviewdocs.txt";
               $text = $attachmentlink . "~d~" . $bibString . "~d~" . $itemTitle . "\n";
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
         * @return int
         */
        public function getAttachment($itemKey, $attachmentKey, $useDate)
        {

            $filepath = dirname(__FILE__, 2)."/resources/temp/".$attachmentKey.".zip";
            $filename = $this->getAttachmentFilename($attachmentKey);
            try {
                $response = $this->apiObject->group($this->groupKey)->items($attachmentKey."/file")->setTimeout(120)->send();
            } catch (Exception $e) {
                return -1;
            }

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