# Fast JS actions

The dashboard package has a lot of front-end scripts based on JS and available from the box. However, you need to know about which classes and data attributes should be used to make them work as you need. 

For making the scripts' using and configuration process easier the fast js actions functionality was developed. The fast JS actions give the possibility to apply the js action to any element which implements interface \Webmagic\Dashboard\Core\Content\JsActionsApplicable. 

Here is the js actions applying process demonstration:
```php
 $btn = (new \Webmagic\Dashboard\Elements\Links\LinkButton())
            ->content('Test button')
            ->link('/')
            ->addClass('delete-me');

$btn->js()->deleteWithConfirmation()->regular(url()->current(),
    '.delete-me', 'GET');

$dashboard = app(\Webmagic\Dashboard\Dashboard::class);

$dashboard->content($btn);

return $dashboard;
```

As you see, all available js actions should be applied with method ->js(). You will see all available js actions with IDE help after calling this method.

You can fully configure all the js action attribute during the js actions applying process
