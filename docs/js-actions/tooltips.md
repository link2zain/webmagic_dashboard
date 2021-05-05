# Tooltips functionality

You can simply add tooltip to any element with using js action

Here is an example

```php
    (new FormGroup())->labelTxt('Checkbox with tooltip')->element()->checkbox()->js()->tooltip()->regular('This is an input with tooltip')->parent()
```

You can also hide not needed tooltip if it was set before

```php
   (new FormGroup())->labelTxt('Checkbox with hidden tooltip')->element()->checkbox()->js()->tooltip()->regular('Hidden tooltip')->js()->tooltip()->hide()->parent()
```

Full example in \Webmagic\Dashboard\Docs\Http\JSActionsPresentationController::tooltips
