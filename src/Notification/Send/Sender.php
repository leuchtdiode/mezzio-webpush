<?php
namespace Try2catch\WebPush\Notification\Send;

use DateTime;
use Exception;
use Log\Log;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;
use Try2catch\WebPush\Notification\SaveData;
use Try2catch\WebPush\Notification\Saver as NotificationSaver;

class Sender
{
	public function __construct(
		private readonly array $config,
		private readonly NotificationSaver $notificationSaver
	)
	{
	}

	/**
	 * @throws Exception
	 */
	public function send(SendParams $data): SendResult
	{
		$result = new SendResult();

		$webPushConfig = $this->config['web-push'] ?? null;

		$this->checkConfigParam('host', $webPushConfig);
		$this->checkConfigParam('public-key', $webPushConfig);
		$this->checkConfigParam('private-key', $webPushConfig);

		$webPush = new WebPush([
			'VAPID' => [
				'subject'    => $webPushConfig['host'],
				'publicKey'  => $webPushConfig['public-key'],
				'privateKey' => $webPushConfig['private-key'],
			],
		]);

		$notification = $data->getNotification();
		$subscription = $notification->getSubscription();

		if (!$subscription)
		{
			throw new Exception('Notification must be loaded with subscription');
		}

		$report = $webPush->sendOneNotification(
			Subscription::create($subscription->getData()),
			json_encode($notification->getPayload())
		);

		Log::debug(serialize($report));

		$notificationSaveData = SaveData::create()
			->setNotification($notification)
			->setSentAt(new DateTime());

		if ($report->isSubscriptionExpired())
		{
			$result->setExpired(true);

			Log::debug('Subscription ' . $subscription->getId() . ' expired');
		}

		if (!$report->isSuccess())
		{
			$notificationSaveData->setError($report->getReason());
		}

		$notificationSaveResult = $this->notificationSaver->save($notificationSaveData);

		if (!$notificationSaveResult->isSuccess())
		{
			$result->setSuccess(false);
			return $result;
		}

		$result->setSuccess(true);

		return $result;
	}

	/**
	 * @throws Exception
	 */
	private function checkConfigParam(mixed $configParam, ?array $config): void
	{
		$value = $config[$configParam] ?? null;

		if ($value === null)
		{
			throw new Exception('Config parameter web-push.' . $configParam . ' missing');
		}
	}
}