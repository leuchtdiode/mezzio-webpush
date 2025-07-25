<?php
declare(strict_types=1);

namespace Try2catch\WebPush\Notification;

use Try2catch\WebPush\Common\ResultTrait;

class SaveResult
{
	use ResultTrait;

	private ?Notification $notification = null;

	public function getNotification(): ?Notification
	{
		return $this->notification;
	}

	public function setNotification(?Notification $notification): void
	{
		$this->notification = $notification;
	}
}