## Visual Editor element
``` \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor```

Visual Editor is an element based on CKEditor and styled for work with AdminLTE panel

### How to use
Visual editor params which you can configure on back-end are almost the same as in TextArea. The main elements features are implemented on front-end

Here is only one important feature which you can control on back end is possibility to turn on uploading images. 
Any selected image will be converted into Base64 format and will be sent together with the content. However, the images can be also saved on the server.
For activating this possibility you should add route for uploading the photos. 

```php
(new \Webmagic\Dashboard\Elements\Forms\Elements\VisualEditor())
->turnOnFileUpload('my-site.com/route/for-saving-images');

// Or via Form generator or FormPageGenerator

(new \Webmagic\Dashboard\Components\FormGenerator())
->visualEditor('description', '', false, 'Description', [],'my-site.com/route/for-saving-images');
```  

Depends on the image saving result you should send back the next responses.

For success 
```json
{
    "uploaded": 1,
    "fileName": "foo.jpg",
    "url": "/files/foo.jpg"
}
```

For error

```json
{
    "uploaded": 0,
    "error": {
        "message": "The file is too big."
    }
}
```

More information about CKEditor files uploading function can be found in official documentation - https://ckeditor.com/docs/ckeditor4/latest/guide/dev_file_upload.html
