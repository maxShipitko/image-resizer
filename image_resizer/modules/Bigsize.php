<?php
namespace Image_resizer\Modules;
/**
* Class Bigsize
* 
* Class Crop is one of library modules;
* One of image side must remain the same. 
* Other side supplemented black stripes.
* 
* @package modules
*/
class Bigsize implements ModuleInterface {
    
    /**
    * method of class Bigsize
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
            $pointX = ($originalWidth-$newWidth)/2;
            $pointY = 0;
        } else {
            $redactWidth = $originalWidth;
            $redactHeight = $newHeight;
            $pointY = ($originalHeight-$newHeight)/2;
            $pointX = 0;
        }

        imagecopyresampled($imageResized, $imgOriginal, 0, 0, $pointX, $pointY, $newWidth, $newHeight , $redactWidth, $redactHeight);

        return $imageResized;
    }
}