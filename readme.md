The library is designed for image cropping. It supports several ways of cropping.

Example
--------

```php

try {

    $resizer = new \Image_resizer\ImageResizer;
    $option = array (
		'type' => 'crop', 
		'width' => 300, 
		'height' => 400
    );
    $resizer->resize('path/to/your/image.jpg', 'path/to/tour/image_directory/', $option);

} catch (\Image_resizer\ImageResizerException $e) {

    echo 'ImageResizer exception: ',  $e->getMessage(), "\n";

}

```

Composer
--------

If you use [Composer](https://getcomposer.org/) add:

```json
{
    "require": {
        "maxShipitko/image-resizer": "1.0"
    }
}

```

Setup
-----

If you not use Composer you can use simple PSR-0 autoloader:

```php

include_once '/image_resizer/imageResizerAutoload.php';

```

Requirements
------------

The extension of image must be jpg, jpeg or png. 
Authors use GD2. Correct work with GD1 is not guaranteed. But you can try ;)

Types of resize
---------------
#### crop
If image proportions change some parts will be cut off (left and right or top and bottom - depending on the proportions)

#### scaling
Resolution of final image limited to your options, not cut off

#### bigsize
One of image side must remain the same. Other side supplemented black stripes.

#### vert
Cuts the upper part of the image. If the width is small left and right sides also cut.

Custom resize
-------------

If you need a custum way you can add your class in image-resizer/modules/your_class.php. Your class must contain the method "resize", which take three arguments:

- image resource (returned by one of the image creation functions, such as imagecreatefromjpeg);
- width;
- height.

This method must return generated image resource. Name of your class is used as a 'type' in the option array. Name of class and name of file must be the same. 
Class must implements the interface ModuleInterface and should be in the Image_resizer\Modules namespace. As an example you can look at any other module.

Authors
-------------

Dmitriy Loburet, 
Nikolay Ablov, 
Maxim Shipitko