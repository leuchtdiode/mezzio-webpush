<?php
namespace Try2catch\WebPush\Subscription;

class RemoveData
{
	private Subscription $subscription;

	public static function create(): self
	{
	    return new self();
	}

	public function getSubscription(): Subscription
	{
		return $this->subscription;
	}

	public function setSubscription(Subscription $subscription): RemoveData
	{
		$this->subscription = $subscription;
		return $this;
	}
}