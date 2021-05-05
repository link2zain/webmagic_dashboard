# Photo upload component

Photo uploading component provides a basic functionality for uploading and deleting images. Photo uploading component can be used as the part of a form or as a standalone component.

## Fast start

The easiest way to use photo uploading component is to use if as a part of a form. In this case it may be turned on by calling function ``\Webmagic\Dashboard\Components\FormGenerator::imageArea``

```php
    return (new FormPageGenerator())->imageArea('photos');
```   

The previously uploaded images can be set as an array

```php
    $loadedPhotos =   [
                'dashboard/images/photo.jpg',
                'dashboard/images/photo2.jpg',
            ];
    
    return  (new FormPageGenerator())->imageArea('photos[]', $loadedPhotos, 'Photo upload');
```  

## Image uploading and deleting handling

The image sends on back-end just after selection. Dashboard API image uploading and deleting route will be set as a default when photo uploading element generates by ``\Webmagic\Dashboard\Components\FormGenerator``. ``\Webmagic\Dashboard\Api\Http\ImagesController`` handles these routes. The images will be store in ``storage/app/public`` directory and will be available with url ``/storage/path_to_image``. The image public path will be returned after the image was store. 

Image storing path can be changed in ``config/webmagic/dashboard/dashboard.php::images_directory``. For making photos available for front-end [the storage public symbolic link should be generated](https://laravel.com/docs/6.x/filesystem#the-public-disk)  

The photo uploading and deleting process can be handled manually by defining custom urls

```php
     $loadedPhotos =   [
                    'dashboard/images/photo.jpg',
                    'dashboard/images/photo2.jpg',
                ];
        
        return  (new FormPageGenerator())->imageArea(
                        'photos[]',                                       // field name
                        $loadedPhotos,                                  // loaded photos
                        'Photo upload',                                 // label
                        false,                                          // required or not
                        true,                                           // multiple files 
                        route('dashboard.api.image.upload', 'photos'),  // upload URL
                        route('dashboard.api.image.delete')             // delete URL
                );
``` 

The request for upload photo sends as POST request. The request for deleting photo sends as DELETE request. Detailed implementation of uploading and deleting process can be seen in ``\Webmagic\Dashboard\Api\Http\ImagesController``

## Using standalone component

Photo uploading component can be used as a standalone component by using ``\Webmagic\Dashboard\Elements\Files\PhotoUploader`` class. In this case all params should be set by the ``\Webmagic\Dashboard\Elements\Files\PhotoUploader`` functions.
