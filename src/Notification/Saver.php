<?php
namespace Try2catch\WebPush\Notification;

use Log\Log;
use Throwable;
use Try2catch\WebPush\Db\Notification\Entity;
use Try2catch\WebPush\Db\Notification\Saver as EntitySaver;
use Try2catch\WebPush\DtoMappingProvider;

class Saver
{
	public function __construct(
		private readonly EntitySaver $entitySaver,
		private readonly Provider $provider,
		private readonly DtoMappingProvider $dtoMappingProvider
	)
	{
	}

	public function save(SaveData $data): SaveResult
	{
		$result = new SaveResult();
		$result->setSuccess(false);

		$mapping = $this->dtoMappingProvider->getNotificationMapping();

		try
		{
			$notification = $data->getNotification();

			$entity = $notification
				? $mapping->getEntity($notification)
				: new Entity();

			if ($data->shouldModify(SaveData::SUBSCRIPTION))
			{
				$entity->setSubscription(
					$this->dtoMappingProvider
						->getSubscriptionMapping()
						->getEntity($data->getSubscription())
				);
			}

			if ($data->shouldModify(SaveData::PAYLOAD))
			{
				$entity->setPayload($data->getPayload());
			}

			if ($data->shouldModify(SaveData::SENT_AT))
			{
				$entity->setSentAt($data->getSentAt());
			}

			if ($data->shouldModify(SaveData::ERROR))
			{
				$entity->setError($data->getError());
			}

			$this->entitySaver->save($entity);

			$result->setNotification(
				$this->provider->byId($entity->getId())
			);
			$result->setSuccess(true);
		}
		catch (Throwable $ex)
		{
			Log::error($ex);
		}

		return $result;
	}
}
