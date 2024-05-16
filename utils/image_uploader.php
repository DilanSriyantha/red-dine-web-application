<?php

class ImageUploader{
    private $image;

    function __construct($image){
        $this->image = $image;
    }

    private function isImageOk(){
        print_r($this->image["name"]);
        $image_ok = getimagesize($this->image["tmp_name"]);
        if($image_ok)
            return true;
        else
            return false;
    }

    public function uploadToFirebaseStorage($prefix){
        require "../firebase_config.php";

        if(!$this->isImageOk()) return null;

        $file_name = $prefix . rand(1111, 9999) . "_" .  $this->image["name"];

        $storage_object = $bucket->upload(
            file_get_contents($this->image["tmp_name"]),
            [
                "name" => $file_name
            ]
        );

        $bucket->object($file_name)->update(
            ["acl" => []],
            ["predifinedAcl" => "PUBLICREAD"]
        );

        $download_link = "https://firebasestorage.googleapis.com/v0/b/red-dine-webapp.appspot.com/o/" . $file_name . "?alt=media";

        return $download_link;
    }
}
?>