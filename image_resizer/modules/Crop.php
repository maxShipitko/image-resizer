<?php
namespace Image_resizer\Modules;
/**
* Class Crop
* 
* Class Crop is one of library modules;
* If image proportions change some parts will be cut off 
* (left and right or top and bottom - depending on the proportions) 
* 
* @package modules
*/
class Crop implements ModuleInterface {
    
    /**
    * method of Crop
    * 
    * @param resource $imgOriginal link
    * @param integer $newWidth width
    * @param integer $newHeight height
    * @return resource
    */
    public function resize($imgOriginal, $newWidth, $newHeight) {
        
        $imageResized = imagecreatetruecolor($newWidth , $newHeight);
        $originalWidth  = imagesx($imgOriginal);  
        $originalHeight = imagesy($imgOriginal); 
        $newRatio = $newWidth/$newHeight;
        $originalRatio = $originalWidth/$originalHeight;

        if ($originalRatio < $newRatio) {       //crop top and bottom               
            $heghtCenter = $originalHeight/2;
            $croppedHeight = $originalWidth/$newRatio;
            $heightShift = ($originalHeight-$croppedHeight)/2;
            $croppedWidth = $originalWidth;
            $widthShift = 0;
        } else {                                //crop left and right
            $widthCenter = $originalWidth/2;
            $croppedWidth = $originalHeight*$newRatio;
            $widthShift = ($originalWidth-$croppedWidth)/2;
            $croppedHeight = $originalHeight;
            $heightShift = 0;           
        }

        imagecopyresampled($imageResized, $imgOriginal, 0, 0, $widthShift, $heightShift, $newWidth, $newHeight , $croppedWidth, $croppedHeight);
        
        return $imageResized;                  
    }
}