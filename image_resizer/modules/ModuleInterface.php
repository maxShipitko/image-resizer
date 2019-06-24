<?php
namespace Image_resizer\Modules;
/**
* interface ModuleInterface
*  
* Interface used by all modules
*/
interface ModuleInterface {

    /**
    * method of interface ModuleInterface
    * 
    * @param resource $imgOriginal link
    * @param integer $newWidth width
    * @param integer $newHeight height
    *
    * @return image resource
    */
    public function resize($imgOriginal, $newWidth, $newHeight);
}