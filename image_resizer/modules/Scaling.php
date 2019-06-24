<?php
namespace Image_resizer\Modules;
/**
* Class Scaling
* 
* Class Scaling is one of library modules;
* Resolution of final image limited to your options, not cut off 
* 
* @package modules
*/
class Scaling implements ModuleInterface {
    
    /**
    * method of class Scaling
    * 
    * @param resource $imgOriginal link
    * @param integer $newWidth width
    * @param integer $newHeight height
    * @return resource
    */
    public function resize($imgOriginal, $newWidth, $newHeight) {
        
        $originalWidth  = imagesx($imgOriginal);  
        $originalHeight = imagesy($imgOriginal); 

        if ($originalWidth/$originalHeight >= 1) {
            $decrease = $originalWidth/$newWidth;
            $redactHeight = $originalHeight/$decrease;
            $redactWidth = $newWidth;
            $newHeight = $redactHeight;
        } else {
            $decrease = $originalHeight/$newHeight;
            $redactWidth = $originalWidth/$decrease;
            $redactHeight = $newHeight;
            $newWidth = $redactWidth;
        }

        $imageResized = imagecreatetruecolor($redactWidth, $redactHeight);
        
        imagecopyresampled($imageResized, $imgOriginal, 0, 0, 0, 0, $redactWidth, $redactHeight , $originalWidth, $originalHeight);

        return $imageResized;
    }
}