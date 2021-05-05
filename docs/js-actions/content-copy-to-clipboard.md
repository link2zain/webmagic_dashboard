# Content copy to clipboard 

Content copy to clipboard is a js action which helps to copy a user data from fields and static data (like text in tags ``div``, ``p``, ``span`` ...). 

Content copy to clipboard applyes by attaching it to the element with ``js()`` method.

```php
        $inputText = (new \Webmagic\Dashboard\Elements\Forms\Elements\Input())
            ->id('id_of_other_element')
            ->addClass('class_of_other_element')
            ->value('Value');

        $btn = (new DefaultButton())->js()
            ->contentCopy()
            ->getElementValueToClipboard('#id_of_other_element')
            ->content('Copy value from other element');
```



You can use 
```php
        ->getElementValueToClipboard('#id_of_other_element')
```

or
```php
        ->getElementValueToClipboard('.class_of_other_element')
```

whatever you want.

But if you use .class then you will get value of first finded element.

If you want to get value of current element use this expression:
```php
        $btn = (new DefaultButton())
            ->addClass('btnClass')
            ->attr('id', 'testId')
            ->js()
            ->contentCopy()
            ->getElementValueToClipboard('.btnClass')
            ->content('Copy value');
``` 

In case above, we use function ``getElementValueToClipboard`` to get value of certain element.
If you need to get attrubute value of current element use ``getCurrentElementAttrToClipboard``:

```php
        $btn = (new DefaultButton())->js()
            ->contentCopy()
            ->getCurrentElementAttrToClipboard('attribute value')
            ->content('copy attribute value');
``` 

In this case, you will get ``attribute value`` to clipboard after click on $btn.