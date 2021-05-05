# Logo Link Element
For prepare logo for your page you should use special element `Webmagic\Dashboard\Elements\Special\LogoLinkElement`

Use next code for define logo:
```php
    $logo_link_element = new \Webmagic\Dashboard\Elements\Special\LogoLinkElement([
        'part_one' => 'Interface',
        'part_two' => 'Generator',
        'part_one_mini' => 'I',
        'part_two_mini' => 'G',
        'link' => url('/'),
    ]);
    $page->setFieldContent($logo_link_element, 'header_logo');
    return $page->render();
```
You will see - http://joxi.ru/D2P3pjvcdwKQ9m and http://joxi.ru/xAevaGVcYMj3kr