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
         * ZoteroController constructor.
         * @param $apiKey
         * @param $groupID
         */
        public function __construct($apiKey, $groupID)
        {
            $this -> apiKey = $apiKey;
            $this -> groupKey = $groupID;
            $this -> apiObject = new Hedii\ZoteroApi\ZoteroApi($this->apiKey);
        }


        public function getAllItems() {
            $response = $this->apiObject->group($this->groupKey)->items()->top()->limit(100)->send();
            $items = json_decode($response->getJson(), false);

            //var_dump($item);
            //$this -> writeDataToFile("datadump.json", $response->getJson());

            foreach($items as $item) {
                //var_dump($item->key);
                $this->getItem($item->key);
            }
        }

        /**
         * Get an item from Zotero DB
         * @param $itemKey
         */
        public function getItem($itemKey)
        {
            $response = $this->apiObject->group($this->groupKey)->items($itemKey)->send();
            $item = json_decode($response->getJson(), false);

            //var_dump($item);
            //$this -> writeDataToFile("datadump".$itemKey.".json", $response->getJson());

            if ($item->data->extra != "") {
                $this->makedir(dirname(__FILE__, 2)."/public/", $item->data->extra);
                if (isset($item->links->attachment)) {
                    $this->makedir(dirname(__FILE__, 2) . "/public/".$item->data->extra."/", $itemKey);
                    $array = explode("/", $item->links->attachment->href);
                    $attachmentKey = $array[count($array)-1];
                    $useDate = $item->data->extra;
                    $this->getAttachment($itemKey, $attachmentKey, $useDate);

                    $attachmentFilename = $this->getAttachmentFilename($attachmentKey);
                    //We should ensure that we did get an attachment before doing this. Maybe return true from "getAttachment"
                    $this->addAttachmentIframe($itemKey, $attachmentKey, $useDate, $attachmentFilename);
                }
            }

        }

        /**
         * Creates Iframe for an Attachment and appends to Media file for correct use date.
         * @param $itemKey
         * @param $attachmentKey
         * @param $useDate
         * @param $attachmentFilename
         */
        public function addAttachmentIframe($itemKey, $attachmentKey, $useDate, $attachmentFilename){
            $textFile = dirname(__FILE__, 2) . "/public/". $useDate . "/" . "media.txt";
           // $fp = fopen($textFile, "w");
            $firstPartURIPath = explode('/', $_SERVER['REQUEST_URI'])[1];
            //TODO this iframelink needs to have the main attachment file appended to the end. Maybe return that from getAttachment function and pass into this one?
            $iframeLink = 'https://' . "$_SERVER[HTTP_HOST]" . '/' . $firstPartURIPath .  "/wp-content/plugins/Book-Archive-Website/public/". $useDate ."/".$itemKey."/".$attachmentKey . "/" . $attachmentFilename;
            $path_parts = pathinfo($attachmentFilename);
            $extension = $path_parts['extension'];
            $iframeText = '<iframe src="' . $iframeLink . '" width="480" height="366" frameBorder="0"  allowFullScreen></iframe><p><a href="' . $iframeLink . '">temp</a></p>';
            file_put_contents ($textFile, $iframeText, FILE_APPEND);
            //fclose($fp);
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