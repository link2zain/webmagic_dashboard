# Confirmation popup 

Confirmation popup is a js action which helps to confirm a user action. Confirmation popup applyes by attaching it to the element with ``js()`` method.

```php
        $btn = (new LinkButton())->content('Action element')
            ->js()->sendRequestOnClick()->regular(url()->current())
            ->js()->confirmationPopup()->regular();
``` 

The confirmation popup title, contend and labels for confirmation and cancel buttons can be override with additional params.

```php
        $btn = (new LinkButton())->content('Action element')
            ->js()->sendRequestOnClick()->regular(url()->current())
            ->js()->confirmationPopup()->regular(
                'Confirm this action',                      // title
                'Please, make sure you want to do this',    // content
                'I confirm',                                // confirm button
                'Do not do this'                            // cancel button    
);
```

**Important** to know that confirmation popup can be applied only for elements with the next action applied:

-  ``sendRequestByClick``
-  ``sendRequestOnChange``
-  submitting form with class ``.js_submit-form-by-click-el``
-  submitting form with class ``.js_submit-form-by-change-el``

If element has no such actions applied no confirmation popup will be shown
