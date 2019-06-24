<?php
namespace Image_resizer;
/**
* Class ImageResizer
*  
* The library is designed for image cropping. 
* It supports several ways of cropping.
*/
class ImageResizer {
    
    /**
    * resize your image and used on of the modules
    *
    * @param string $originalFile path to your image
    * @param string $pathToNew path to your image directory
    * @param array $options your options
    * array $options(
    *   [string $type = 'name of module'], 
    *   [integer $width = 'your width'], 
    *   [integer $height = 'your height']
    * ); 
    *
    * @throws ImageResizerException file not exist
    * @throws ImageResizerException size can not be zero or negative
    * @throws ImageResizerException module no implements the interface ModuleInterface
    */
    public function resize($originalFile, $pathToNew, $options) {
        
        if (file_exists($originalFile) != true) {
            throw new ImageResizerException('file not exist');	
        }
        if ($options['width'] <= 0 or $options['height'] <= 0) {
            throw new ImageResizerException('size can not be zero or negative');
        }
        
        $specificResizerClass = '\\Image_resizer\\Modules\\'.$options['type']; 
        $specificResizer = new $specificResizerClass;

        if (!in_array('Image_resizer\Modules\ModuleInterface', class_implements($specificResizer))) {
            throw new ImageResizerException('module no implements the interface ModuleInterface');
        }
        
        $im = $this->__createImageResource($originalFile);	
        $newIm = $specificResizer->resize($im, $options['width'], $options['height']);		
        $name = pathinfo($originalFile, PATHINFO_FILENAME).'_'.$options['type'];
        $extension = pathinfo($originalFile, PATHINFO_EXTENSION);
        
        $this->__saveImage($newIm, $pathToNew, $name, $extension);				
    }
    
    /**
    * creates image and return resource link
    *
    * @access private
    *
    * @param string $pathToFile path to tour image
    *
    * @throws ImageResizerException the file extension is not supported
    *
    * @return image resource
    */
    private function __createImageResource($pathToFile) {
        
        $extension = pathinfo($pathToFile, PATHINFO_EXTENSION);
        
        if ($extension == 'jpg' || $extension == 'jpeg') {
            return imagecreatefromjpeg($pathToFile);
        } elseif ($extension == 'png') {
            return imagecreatefrompng($pathToFile);  
        } else {
            throw new ImageResizerException('error ImageResizer: the file extension is not supported');
        }			
    }
    
    /**
    * method determines save image on directory
    *
    * @access private
    *
    * @param resource $imageResource link to resource
    * @param string $pathToSave path to save new image
    * @param string $nameOfFile name of file
    * @param string $extension extension of input image
    */
    private function __saveImage($imageResource, $pathToSave, $nameOfFile, $extension){
        
        if (!is_dir($pathToSave)) {
            mkdir($pathToSave);
        }
        
        switch($extension) {  
            case 'jpg':  
            case 'jpeg':  
                imagejpeg ($imageResource, $pathToSave.$nameOfFile.'.jpg');
                break;  
            case 'png':  
                imagepng ($imageResource, $pathToSave.$nameOfFile.'.png'); 
                break;  
        }
    }
}
