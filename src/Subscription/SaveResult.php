<?php
namespace Try2catch\WebPush\Subscription;

use Try2catch\WebPush\Common\ResultTrait;

class SaveResult
{
	use ResultTrait;

	private ?Subscription $subscription = null;

	public function getSubscription(): ?Subscription
	{
		return $this->subscription;
	}

	public function setSubscription(?Subscription $subscription): void
	{
		$this->subscription = $subscription;
	}
}