<?php
namespace Image_resizer\Modules;
/**
* Class Vert
* 
* Class Vert is one of library modules;
* Cuts the upper part of the image. 
* If the width is small left and right sides also cut. 
* 
* @package modules 
*/
class Vert implements ModuleInterface {

    /**
    * method of class Vert
    * 
    * @param resource $imgOriginal link
    * @param integer $newWidth width
    * @param integer $newHeight height
    * @return resource
    */
    public function resize($imgOriginal, $newWidth, $newHeight) {

        $imageResized = imagecreatetruecolor($newWidth, $newHeight);
        $originalWidth  = imagesx($imgOriginal);  
        $originalHeight = imagesy($imgOriginal); 

        if ($originalWidth < $newWidth) {
            $redactWidth = $newWidth;
            $redactHeight = $originalHeight;
        }

        else {
            $redactWidth = $originalWidth;
            $redactHeight = $newHeight;
        }

        imagecopyresampled($imageResized, $imgOriginal, 0, 0, 0, 0, $newWidth, $newHeight , $redactWidth, $redactHeight);

        return $imageResized;
    }
}