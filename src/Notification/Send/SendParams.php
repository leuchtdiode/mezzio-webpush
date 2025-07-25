<?php
namespace Try2catch\WebPush\Notification\Send;

use Try2catch\WebPush\Notification\Notification;

class SendParams
{
	private Notification $notification;

	public static function create(): self
	{
		return new self();
	}

	public function getNotification(): Notification
	{
		return $this->notification;
	}

	public function setNotification(Notification $notification): SendParams
	{
		$this->notification = $notification;
		return $this;
	}
}