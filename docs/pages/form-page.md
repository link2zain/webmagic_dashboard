# Form page generation

## Full table page generation example

```php
$img = 'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500';    

$formPageGenerator = (new \Webmagic\Dashboard\Components\FormPageGenerator())
    ->title('Page title', 'Page sub-title')
    ->method('POST')    // default POST
    ->action('/')        // default '/'
    ->ajax(true)         // set form to send with Ajax. Default 'true'
    ->textInput('name', 'Dfault value', 'Name', true)
    ->numberInput('number', 0, 'Number input', false, 0.01)
    ->emailInput('email', null, 'Email', true)
    ->passwordInput('password', '', 'Password', true)
    ->colorInput('color', '#000000', 'Select color', false)
    ->checkbox('checkbox_name', false, 'Check me')
    ->switcher('switcher_name', true, 'Switch me')
    // Regular date input
    ->dateInput('date', today(), 'Date', true)
    // Date picker JS
    ->datePickerJS('date_js', today(), 'Select date with JS', true)
    // Date range picker
    ->dateRangePicker('date_range_start', 'date_range_end', today(), today(), 'Select range of dates', false, false)
    // Regular time picker
    ->timeInput('time', now(), 'Time')
    // Time picker JS
    ->timePickerJS('time_js', now(), 'Select time with JS')
    // Regular date and time input
    ->dateTimeInput('date_time', now(), 'DateTime', false)
    // Date and time picker with JS
    ->dateTimePickerJS('date_time_js', now(), 'Select date and time with JS', false)
    // Date and time range picker
    ->dateTimeRangePicker('date_time_range_start', 'date_time_range_end', today(), today(), 'Select range of dates and times', false, false)
    // Regular select
    ->select('select', [1 => 'Option 1', 2 => 'Option 2'], 2, 'Select me', false)
    // Multiply select
    ->select('select', [1 => 'Option 1', 2 => 'Option 2'], 2, 'Select me twice', false, true)
    // Regular JS select
    ->selectJS('select', [1 => 'Option 1', 2 => 'Option 2'], 2, 'Select me with JS', false)
    // Multiply JS select
    ->selectJS('select', [1 => 'Option 1', 2 => 'Option 2'], 2, 'Select me twice with JS', false, true)
    // JS Select with autocomplete on back-end
    ->selectWithAutocomplete('select', route('dashboard.docs.presentation.select-autocomplete'), [1 => 'London', 5 => 'Paris'],1, 'Search with back-end autocomplete', false, true)
    ->textarea('comment', '', 'Comment')
    ->visualEditor('content', '', 'Editor', true)
    ->fileInput('file', request(), 'File')
    ->imageInput('testImag', $img,'Image block', '20 Mb', '10', '234', $img, 'myImage.png')
    ->submitButtonTitle('Push me')
    // Add additional button to submit the form with additional params which will be send to backend
    ->addSubmitButton(['redirect' => url('dashboard')], 'Submit and back to dashboard')
    // Add additional link button
    ->addLinkButton(url('/'), 'Go home')
    ->hiddenInput('hidden_attribute', null)
    // Custom input with possiblity to configure all parameters
    ->input('test_name', 'Submit with custom input', '', 'submit', false, '', [], 'btn btn-default');

return $formPageGenerator;
```

### View live example

* Activate 'presentation_mode' in config/webmagic/dashboard/dashboard.php
* Visit '/dashboard/tech/form-page'
