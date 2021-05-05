<?php


namespace Webmagic\Dashboard\Pages;

use Webmagic\Dashboard\NotificationService\NotificationService;

/*********************************************************************************************************************
 * Generated meta methods
 *********************************************************************************************************************
 *
 * @method \Webmagic\Dashboard\Pages\BasePage headerLogo($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage addHeaderLogo($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage headerNav($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage addHeaderNav($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage mainSidebar($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage addMainSidebar($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage contentHeader($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage addContentHeader($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage notificationArea($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage addNotificationArea($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage data($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage addData($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage footer($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage addFooter($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage title($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage addTitle($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage class($valueOrConfig)
 * @method \Webmagic\Dashboard\Pages\BasePage addClass($valueOrConfig)
 *
 ********************************************************************************************************************/

class BasePage extends Page
{
    /** @var string  */
    protected $view = 'dashboard::pages.base_page';

    protected $available_fields = [
        'header_logo',
        'header_nav',
        'main_sidebar',
        'content_header',
	    'notification_area',
	    'data',
        'footer',
        'title',
        'class'
    ];

    protected $default_field = 'data';

	protected $isGlobalNotificationsAllowed = true;


	/**
     * Set page meta title and title
     *
     * @param string $title
     * @param string $subTitle
     *
     * @return BasePage
     */
    public function setPageTitle(string $title, string $subTitle = ''): BasePage
    {
        $this->title($title);
        $this->element('content_header')->h1Title($title)->subTitle($subTitle);

        return $this;
    }

	/**
	 * Add notifications to page before render()
	 *
	 * @return BasePage
	 */
	private function addGlobalNotifications(): BasePage
	{
		/** @var NotificationService $notificationService */
		$notificationService = app()->make(NotificationService::class);

		if ($notificationService->isNotEmpty()) {
			foreach ($notificationService->getAllMessages() as $key => $messages) {
				// set default type & icon style
				$type = $icon = 'fas fa-info';
				foreach ($messages as $message) {
					if ($notificationService->isTypeAvailable($key)) {
						$type = $key;
						$icon = $notificationService->getIconForType($key);
					}
					$this->addElement('notification_area')
						->notification()->title(ucfirst($key))->text($message)->type($type)->icon($icon);

				}
			}
		}

		return $this;
	}

	/**
	 * Disable global notifications before render()
	 */
	public function turnOffGlobalNotifications()
	{
		$this->isGlobalNotificationsAllowed = false;
	}

	/**
	 * Set custom notification to page
	 *
	 * @param string $title
	 * @param string $text
	 * @param bool   $closeButton
	 * @param string $type
	 * @param string $icon
	 *
	 * @return BasePage
	 */
	public function showNotification(
		string $title,
		string $text = '',
		bool $closeButton = true,
		string $type = 'info',
		string $icon = 'fas fa-info'
	): BasePage {
		$this->addElement('notification_area')
			->notification()->title($title)->text($text)->button($closeButton)->type($type)->icon($icon);

		return $this;
	}

	/**
	 * Show Info notification
	 *
	 * @param string $title
	 * @param string $text
	 * @param bool $closeButton
	 * @return BasePage
	 */
	public function showInfoNotification(string $title, string $text = '', bool $closeButton = true): BasePage
	{
		return $this->showNotification($title, $text, $closeButton, 'info', 'fas fa-info');
	}

	/**
	 * Show Danger notification
	 *
	 * @param string $title
	 * @param string $text
	 * @param bool $closeButton
	 * @return BasePage
	 */
	public function showDangerNotification(string $title, string $text = '', bool $closeButton = true): BasePage
	{
		return $this->showNotification($title, $text, $closeButton, 'danger', 'fas fa-ban');
	}

	/**
	 * Show Warning notification
	 *
	 * @param string $title
	 * @param string $text
	 * @param bool $closeButton
	 * @return BasePage
	 */
	public function showWarningNotification(string $title, string $text = '', bool $closeButton = true): BasePage
	{
		return $this->showNotification($title, $text, $closeButton, 'warning', 'fas fa-exclamation-circle');
	}

	/**
	 * Show Warning notification
	 *
	 * @param string $title
	 * @param string $text
	 * @param bool $closeButton
	 * @return BasePage
	 */
	public function showSuccessNotification(string $title, string $text = '', bool $closeButton = true): BasePage
	{
		return $this->showNotification($title, $text, $closeButton, 'success', 'fas fa-check');
	}

	/**
	 * @inheritDoc
	 * @return string
	 */
	public function render(): string
	{
		if($this->isGlobalNotificationsAllowed) {
			$this->addGlobalNotifications();
		}

		return parent::render(); // TODO: Change the autogenerated stub
	}
}
