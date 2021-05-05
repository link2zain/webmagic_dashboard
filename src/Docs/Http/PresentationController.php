<?php


namespace Webmagic\Dashboard\Docs\Http;

use Carbon\Carbon;
use Exception;
use Faker\Generator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Webmagic\Dashboard\Components\FormPageGenerator;
use Webmagic\Dashboard\Components\TablePageGenerator;
use Webmagic\Dashboard\Components\TilesListPageGenerator;
use Webmagic\Dashboard\Core\Content\ContentFieldsUsable;
use Webmagic\Dashboard\Core\Content\Exceptions\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\Exceptions\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Dashboard;
use Webmagic\Dashboard\Elements\Boxes\Box;
use Webmagic\Dashboard\Elements\Buttons\DefaultButton;
use Webmagic\Dashboard\Elements\Factories\ElementsCreateAbleContract;
use Webmagic\Dashboard\Elements\Factories\ElementsFactory;
use Webmagic\Dashboard\Elements\Links\Link;
use Webmagic\Dashboard\Elements\WrapperSpan;

class PresentationController
{
    /**
     * Table page generation description
     *
     * @param Dashboard $dashboard
     *
     * @return Dashboard
     * @throws NoOneFieldsWereDefined
     */
    public function tablePageDescription(Dashboard $dashboard)
    {
        $content = view()->file(__DIR__ . '/../../../docs/pages/table-page.md');

        $dashboard->page()
            ->addElement()
            ->box()
            ->addToolsLinkButton(
                route('dashboard.docs.presentation.table-page'),
                'Example',
                '',
                'btn-info'
            )
            ->content($content);

        return $dashboard;
    }

    /**
     * Prepare Table Page for presentation
     *
     * @return mixed
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function tablePage()
    {
        /** @var Generator $faker */
        $faker = app(Generator::class);
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'id'      => $faker->numberBetween(0, 100),
                'name'    => $faker->name,
                'address' => $faker->address,
            ];
        }

        $paginator = new LengthAwarePaginator($data, 100, 10, 5);

        $tableGenerator = (new TablePageGenerator())
            ->title('Page title', 'Page subtitle')
            // Add items
            ->items($data)
            // Set titles
            ->tableTitles('ID', 'Address')
            // Alternative setting titles
            ->tableTitles(['ID', 'Address'])
            // Add additional title
            ->addTableTitle('Address && Name')
            // Add title with sorting
            ->addTitleWithSorting('New field', 'sortingFieldName', 'desc', true, request()->url(), 'GET')
            // Limit fields to show
            ->showOnly('id', 'address', 'address-name', 'new-field', 'second-new-field')
            // Add additional fields and items  fields handlers
            ->setConfig([
                'address'      => function ($item) {
                    return (new Link())->content($item['address'])->link('/');
                },
                'address-name' => function ($item) {
                    return '<b>' . $item['name'] . '</b> (' . $item['address'] . ')';
                },
                'new-field'    => 'New field static content',
            ])
            // Add one additional field to content
            ->addToConfig('second-new-field', function ($item) {
                return 'New field static - ' . $item['id'];
            })
            // Add crude links
            ->createLink(url('/'))
            ->setEditLinkClosure(function ($item) {
                return url('/edit', ['id' => $item['id']]);
            })
            ->setShowLinkClosure(function ($item) {
                return url('/view', ['id' => $item['id']]);
            })
            ->setDestroyLinkClosure(function ($item) {
                return url('/destroy', ['id' => $item['id']]);
            })
            // Add custom element to tool column
            ->addElementsToToolsCollection(function ($item) {
                return (new DefaultButton())
                    ->content($item['name'])->js()->tooltip()->regular('Test button description');
            })
            // Add pagination
            ->withPagination($paginator, request()->url())
            // Add additional tool button
            ->addToolsLinkButton('/', 'New tool button', 'fas fa-plus')
            // Activate bulk actions functionality
            ->bulkActions([
                url()->current() => 'Action 1',
                url('/')         => 'Action 2',
            ], function ($item) {
                return $item['id'];
            })
            // Manual sorting activation
            ->manualSorting(url()->current(), function ($item) {
                return $item['id'];
            }, 'GET');

	    $tableGenerator->getPage()->showDangerNotification('Danger!', 'Lorem ipsum...');

	    // Add filtering
        $tableGenerator->addFiltering()
            ->action(request()->url())
            ->method('GET')
            ->simpleSelect('name', ['Dan', 'Vincent'], request(), 'Name', true)
            ->dateTimeInput('date', today(), 'Date', false)
            ->submitButton('Filter')
            ->clearButton('Clear');

        // Return table only for new paginated or filtering page
        if (request()->ajax()) {
            return $tableGenerator->getTable();
        }

        return $tableGenerator;
    }

    /**
     * Show tiles list page description
     *
     * @param Dashboard $dashboard
     *
     * @return Dashboard
     * @throws NoOneFieldsWereDefined
     */
    public function tilesListPageDescription(Dashboard $dashboard)
    {
        $content = view()->file(__DIR__ . '/../../../docs/pages/tiles-list-page.md');

        $dashboard->page()
            ->addElement()
            ->box()
            ->addToolsLinkButton(
                route('dashboard.docs.presentation.tiles-list-page'),
                'Example',
                '',
                'btn-info'
            )
            ->content($content);

        return $dashboard;
    }

    /**
     * Show tiles list page demosntration
     *
     * @return string|TilesListPageGenerator
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function tilesListPage()
    {
        /** @var Generator $faker */
        $faker = app(Generator::class);
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'id'      => $faker->numberBetween(0, 100),
                'name'    => $faker->name,
                'address' => $faker->address,
            ];
        }

        $paginator = new LengthAwarePaginator($data, 100, 10, 5);

        $tilesListPage = (new TilesListPageGenerator())
            ->title('Tiles page title', 'Tiles page subtitle')
            // Add items
            ->setItems($data)
            // Limit fields to show
            ->setOnly('name', 'tmp', 'second-new-field')
            ->setConfig([
                'tmp' => function (array $item) {
                    return $item['name'] . ' : ' . $item['address'];
                },
            ])
            // Add one additional field to content
            ->addToConfig('second-new-field', function ($item) {
                return 'New field startic - ' . $item['id'];
            })
            // Set closure to replace the default rendering
            ->setItemRenderingClosure(function ($item) {
                return app(ElementsFactory::class)
                    ->box()->content($item['name'])->makeSimple();
            })
            // Add pagination
            ->withPagination($paginator, url()->current());

	    $tilesListPage->getPage()->showInfoNotification('Info!', 'Lorem ipsum...');

	    // Add filtering
        $tilesListPage
            // Filter into the box
            ->addFiltering(true)
            ->simpleSelect('name', ['Dan', 'Vincent'], request(), 'Name', true)
            ->dateTimeInput('date', today(), 'Date', false)
            ->submitButton('Filter');

        if (request()->ajax()) {
            return $tilesListPage->prepareContent();
        }

        return $tilesListPage;
    }

    /**
     * Prepare Form Page for presentation
     *
     * @return FormPageGenerator
     * @throws Exception
     */
    public function formPage()
    {
        $img = 'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500';

        /** @var FormPageGenerator $formPageGenerator */
        $formPageGenerator = (new FormPageGenerator())
            ->title('Page title', 'Page sub-title')
            ->method('POST')    // default POST
            ->action('/')        // default '/'
            ->ajax(true)         // set form to send with Ajax. Default 'true'
            ->input('test_name', 'Submit with custom input', '', 'submit', false, '', [], 'btn btn-default')
            ->hiddenInput('hidden_attribute', null)
            ->textInput('name', null, 'Name', true)
            ->slugInput('slug', 'name', null, 'Slug generated automatically based on name', false, '-', 'lowercase')
            ->numberInput('number', 0, 'Number input', false, 0.01)
            ->emailInput('email', 'tesdt@email.com', 'Email', true)
            ->passwordInput('password', '123', 'Password', true)
            ->colorInput('color', '#000000', 'Select color', false)
            ->checkbox('checkbox_name', false, 'Check me')
            ->switcher('switcher_name', true, 'Switch me')
            // Regular date input
            ->dateInput('date', today(), 'Date', true)
            // Date picker JS
            ->datePickerJS('date_js', today(), 'Select date with JS', true, [])
            // Date range picker
            ->dateRangePicker('date_range_start', 'date_range_end', today(), today(), 'Select range of dates', true, true)
            // Regular time picker
            ->timeInput('time', now(), 'Time')
            // Time picker JS
            ->timePickerJS('time_js', now(), 'Select time with JS', false, [], true, true)
            // Regular date and time input
            ->dateTimeInput('date_time', now(), 'DateTime', false)
            // Date and time picker with JS
            ->dateTimePickerJS('date_time_js', now(), 'Select date and time with JS', false, [], true, true)
            // Date and time range picker
            ->dateTimeRangePicker('date_time_range_start', 'date_time_range_end', today(), today(),
                'Select range of dates and times', false, false, [], true, true)
            // Regular select
            ->select('select', [1 => 'Option 1', 2 => 'Option 2'], 2, 'Select me', false)
            // Multiply select
            ->select('select', [1 => 'Option 1', 2 => 'Option 2'], 2, 'Select me twice', false, true)
            // Regular JS select
            ->selectJS('select', [1 => 'Option 1', 2 => 'Option 2'], 2, 'Select me with JS', false)
            // JS Select with autocomplete on back-end
            ->selectWithAutocomplete('select', route('dashboard.docs.presentation.select-autocomplete'), [1 => 'London', 5 => 'Paris'],1, 'Search with back-end autocomplete', false, true)
            ->textarea('comment', '', 'Comment')
            ->visualEditor('content', '<p>test</p>', 'Editor', true, ['disabled' => true]) // Additional params can turn on image uploading functionality
            ->fileInput('file', request(), 'File')
            ->imageInput('testImag', $img, 'Image block', '20 Mb', '10', '234', $img, 'myImage.png')
            ->submitButtonTitle('Push me')
            // Add additional button to submit the form with additional params which will be send to backend
            ->addSubmitButton(['redirect' => url('dashboard')], 'Submit and back to dashboard')
            // Add additional link button
            ->addLinkButton(url('/'), 'Go home')
            ->clearButton();

        $formPageGenerator->getForm()->sendAllCheckbox(true);

	    $formPageGenerator->getPage()->showSuccessNotification('Success!', 'Use it like on other types of pages ;)');

	    return $formPageGenerator;
    }

    /**
     * Date Dropdown element presentation
     *
     * @param Dashboard $dashboard
     *
     * @return Dashboard
     */
    public function dateDropdown(Dashboard $dashboard)
    {
        $dashboard->page()->element()->box()->headerAvailable(false)->footerAvailable(false)
            ->element()->form()
            ->element()->dateDropdown()
            ->options([
                Carbon::today()->subWeek() . '/' . Carbon::today()   => 'Last week',
                Carbon::today()->subMonth() . '/' . Carbon::today()  => 'Last month',
                Carbon::today()->subMonth(3) . '/' . Carbon::today() => 'Last 3 months',
                Carbon::today()->subYear() . '/' . Carbon::today()   => 'Last year',
            ]);

        return $dashboard;
    }

    /**
     * Page for demonstration image displaying components
     *
     * @param Dashboard $dashboard
     *
     * @return Dashboard
     * @throws NoOneFieldsWereDefined
     */
    public function imageDisplaying(Dashboard $dashboard)
    {
        $elFactory = app(ElementsFactory::class);

        $img = 'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500';

        // Simple image preview
        $el = $elFactory->imagePreview();

        $el2 = $elFactory->imagePreview()
            ->imgUrl($img)
            ->size('100 Mb')
            ->downloadUrl($img);

        // Image input for using inside form
        $el3 = $elFactory->imageInput()
            ->addClass('col-6  col-md-4 col-lg-3')
            ->imgUrl($img)
            ->size('10 Mb')->width('50')->height('14')
            ->title('Cool image component');

        // Stand alone full functional iamge input
        $el4 = $elFactory->imageComponent()
            ->addClass('col-6  col-md-4 col-lg-3')
            ->imgUrl($img)
            ->size('10 Mb')->width('50')->height('14')
            ->title('Cool image component');

        $copyBtn = '<button class="btn btn-primary js_copy-cnt" data-copy="link"> <i class="far fa-copy"></i> Copy link </button>';
        $copyBtn2 = '<br><br>
                <div class="form-group clearfix" data-original-title="" title="">
                <label for="copy-input-text" data-original-title="" title="">Name</label>
                   <textarea id="copy-input-text" class="form-control" type="text" name="name"> </textarea>           
                </div>
                <button class="btn btn-primary js_copy-cnt" data-el="#copy-input-text"> 
                <i class="far fa-copy"></i> Copy cnt </button>';
        $copyBtn3 = '<br><br>
                <div id="copy-text-el" >
                    <p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusantium at facere harum, modi molestiae necessitatibus neque nostrum obcaecati officiis? Expedita explicabo, officia pariatur placeat quam quidem quo repellat temporibus.</span><span>A accusamus, asperiores doloremque dolores ipsam laborum maiores nulla officiis qui quibusdam quidem quod repudiandae rerum unde velit veritatis vero. Aliquam consectetur natus pariatur sed sequi? At doloribus hic numquam.</span><span>Animi quibusdam, voluptate? Ad ducimus enim error perferendis sunt totam veniam voluptas voluptate! Aliquam commodi culpa eaque est excepturi illum, ipsa labore obcaecati pariatur porro provident sapiente sint sunt, vitae.</span><span>At doloremque enim eum explicabo natus odit recusandae ut vitae. Adipisci asperiores culpa debitis deserunt dolore doloremque dolores eum incidunt ipsam molestiae, nostrum nulla rem sit tempore unde velit voluptas.</span><span>A accusamus consequuntur eaque fugiat illum ipsa magni mollitia, nulla, odio porro quas quisquam repudiandae sapiente, sint sunt. Hic possimus provident recusandae. Beatae cum deleniti, eius quam tenetur velit? Eius!</span><span>A aut, autem doloremque enim et inventore iste libero maxime nam odio rem sapiente sint vitae. A culpa, doloribus ducimus error ipsum iste iure quas quibusdam quidem ut, voluptatem, voluptatum!</span></p> 
                </div>
                <button class="btn btn-primary js_copy-cnt" data-el="#copy-text-el"> 
                <i class="far fa-copy"></i> Copy cnt </button><br><br>';

        $dashboard->addContent([$copyBtn, $copyBtn2, $copyBtn3, '<div class="row">', $el3, $el4, '</div>', $el, $el2]);

        return $dashboard;
    }

    /**
     * JS actions description
     *
     * @param Dashboard $dashboard
     *
     * @return Dashboard
     * @throws NoOneFieldsWereDefined
     */
    public function jsActions(Dashboard $dashboard)
    {
        $content = view()->file(__DIR__ . '/../../../docs/js-actions.md');

        $dashboard->page()->addElement()
            ->box()
            ->headerAvailable(false)
            ->content($content);

        return $dashboard;
    }

    /**
     * @return JsonResponse
     */
    public function autoComplete()
    {
        $data = [
            'results' => [
                [
                    'id' => 1,
                    'text' => 'London',
                ],
                [
                    'id' => 2,
                    'text' => 'New York',
                ]
            ],
        ];

        return response()->json($data);
    }

    /**
     * Content auto update demonstration
     *
     * @param Dashboard $dashboard
     *
     * @return mixed|ContentFieldsUsable|Dashboard|ElementsCreateAbleContract
     * @throws NoOneFieldsWereDefined
     */
    public function autoUpdate(Dashboard $dashboard)
    {
//        $class = 'js-update-'.uniqid();
        $dashboard->page()
            ->setPageTitle('Auto update testing page')
            ->element()
            ->box()
//            ->addClass($class)
            ->boxTitle('This box update itself')
            ->element()
            ->button()->content("<i class='fas fa-cog fa-spin'></i> Updating button < Server time - " . now()->format('H:i:s') . ' >')
            ->js()->contentAutoUpdate()->replaceCurrentElWithContent(route('dashboard.docs.presentation.auto-update'),
                'GET', 5000);


        if (request()->ajax()) {
            return $dashboard->page()->content()->content();
        }

        return $dashboard;
    }

	/**
	 * Notifications generation description
	 *
	 * @param Dashboard $dashboard
	 *
	 * @return Dashboard
	 * @throws NoOneFieldsWereDefined
	 */
	public function notificationsDescription(Dashboard $dashboard)
	{
		$content = view()->file(__DIR__.'/../../../docs/elements/notifications.md');

		$dashboard->page()
			->addElement()
			->box()
			->addToolsLinkButton(
				route('dashboard.docs.presentation.notifications'),
				'Example',
				'',
				'btn-info'
			)
			->content($content);

		return $dashboard;
	}

	/**
	 * Notification examples
	 *
	 * @param Dashboard $dashboard
	 * @return Dashboard
	 */
	public function notifications(Dashboard $dashboard)
	{
		$dashboard->page()
			->showSuccessNotification('Success!', 'Lorem ipsum')
			->showInfoNotification('Info!', 'Lorem ipsum', false)
			->showWarningNotification('Warning!', 'Lorem ipsum')
			->showDangerNotification('Danger!', 'Lorem ipsum', false);

		return $dashboard;
	}

    /**
     * Files uploading example
     *
     * @param Request $request
     *
     * @return FormPageGenerator|Dashboard
     * @throws FieldUnavailable
     * @throws NoOneFieldsWereDefined
     */
    public function photoUploading(Request $request)
    {
        $content = view()->file(__DIR__ . '/../../../docs/elements/photo-uploads.md');
        $box = (new Box())->makeSimple()->content($content);

        $loadedPhotos =   [
            'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg',
            config('webmagic.dashboard.dashboard.default_image')
        ];

        $formPageGenerator =  (new FormPageGenerator())->imageArea('photos[]', $loadedPhotos,'Photo upload');

        $formPageGenerator->getPage()->addContent($box, 'data', true);

        return  $formPageGenerator;
    }
}
