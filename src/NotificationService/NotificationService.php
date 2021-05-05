<?php

namespace Webmagic\Dashboard\NotificationService;


use Illuminate\Support\MessageBag;

class NotificationService
{
	/**
	 * @var MessageBag
	 */
	protected $messages;

	/**
	 * @var array
	 */
	protected $types;

	/**
	 * NotificationService constructor.
	 */
	public function __construct()
	{
		$this->messages = new MessageBag();

		$this->types = config('webmagic.dashboard.dashboard.available_notification_types');
	}

	/**
	 * Add single message
	 *
	 * @param string $key
	 * @param string $message
	 */
	public function addMessage(string $key = 'info', string $message = '')
	{
		$this->messages->add($key, $message);
	}

	/**
	 * Get all messages grouped by key
	 *
	 * @return array
	 */
	public function getAllMessages() : array
	{
		return $this->messages->getMessages();
	}

	/**
	 * Get first message for given key
	 *
	 * @param string|null $key
	 * @return string
	 */
	public function getFirstMessage(string $key = null) : string
	{
		return $this->messages->first($key);
	}

	/**
	 * Get all messages for given key
	 *
	 * @param string $key
	 * @return array
	 */
	public function getGroup(string $key) : array
	{
		return $this->messages->get($key);
	}

	/**
	 * Is service has any messages
	 *
	 * @return bool
	 */
	public function isNotEmpty() : bool
	{
		return $this->messages->isNotEmpty();
	}

	/**
	 * Check, is message type available by default
	 *
	 * @param string $type
	 * @return bool
	 */
	public function isTypeAvailable(string $type) : bool
	{
		return isset($this->types[$type]);
	}

	/**
	 * Get icon for type
	 *
	 * @param string $type
	 * @return string
	 */
	public function getIconForType(string $type) : string
	{
		if(!isset($this->types[$type])){
			return '';
		}

		return $this->types[$type];
	}
}
