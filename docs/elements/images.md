# Images displaying variants


```php
$elFactory = app(\Webmagic\Dashboard\Elements\Factories\ElementsFactory::class);

$img = 'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500';

// Simple image preview
$el = $elFactory->imagePreview();

$el2 = $elFactory->imagePreview()
    ->imgUrl($img)
    ->size('100 Mb')
    ->downloadUrl($img);

// Image input for using inside form
$el3 = $elFactory->imageInput()
    ->addClass('col-md-2')
    ->imgUrl($img)
    ->size('10 Mb')->width('50')->height('14')
    ->title('Cool image component');
    
// Stand alone full functional iamge input
$el4 = $elFactory->imageComponent()
    ->addClass('col-md-2')
    ->imgUrl($img)
    ->size('10 Mb')->width('50')->height('14')
    ->title('Cool image component');

$dashboard->addContent([$el3, $el4, $el, $el2]);

return $dashboard;
```

See example on /dashboard/tech/images in presentation mode


