<?php
declare(strict_types=1);

namespace Try2catch\WebPush\Notification;

use Common\Dto\CreateOptions as CommonDtoCreateOptions;

class CreateOptions implements CommonDtoCreateOptions
{
	private bool $subscription = false;

	public static function create(): self
	{
		return new self();
	}

	public function isSubscription(): bool
	{
		return $this->subscription;
	}

	public function setSubscription(bool $subscription): CreateOptions
	{
		$this->subscription = $subscription;
		return $this;
	}
}