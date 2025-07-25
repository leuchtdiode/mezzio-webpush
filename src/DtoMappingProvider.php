<?php
declare(strict_types=1);

namespace Try2catch\WebPush;

use Exception;
use Try2catch\WebPush\Notification\Mapping as NotificationMapping;
use Try2catch\WebPush\Subscription\Mapping as SubscriptionMapping;

/**
 * @method NotificationMapping getNotificationMapping()
 * @method SubscriptionMapping getSubscriptionMapping()
 */
readonly class DtoMappingProvider
{
	public function __construct(
		private NotificationMapping $notificationMapping,
		private SubscriptionMapping $subscriptionMapping,
	)
	{
		$this->setUp();
	}

	public function setUp(): void
	{
		$this->notificationMapping->setSubscriptionMapping($this->subscriptionMapping);
	}

	/**
	 * @throws Exception
	 */
	public function __call(string $name, array $arguments): mixed
	{
		if (str_starts_with($name, 'get'))
		{
			$property = lcfirst(
				substr($name, 3)
			);

			return $this->{$property};
		}

		throw new Exception('Could not handle method ' . $name);
	}
}