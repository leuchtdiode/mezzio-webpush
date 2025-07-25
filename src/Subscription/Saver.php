<?php
namespace Try2catch\WebPush\Subscription;

use Log\Log;
use Throwable;
use Try2catch\WebPush\Db\Subscription\Entity;
use Try2catch\WebPush\Db\Subscription\Saver as EntitySaver;
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

		$mapping = $this->dtoMappingProvider->getSubscriptionMapping();

		try
		{
			$subscription = $data->getSubscription();

			$entity = $subscription
				? $mapping->getEntity($subscription)
				: new Entity();

			if ($data->shouldModify(SaveData::ENDPOINT))
			{
				$entity->setEndpoint($data->getEndpoint());
			}

			if ($data->shouldModify(SaveData::NAME))
			{
				$entity->setName($data->getName());
			}

			if ($data->shouldModify(SaveData::DATA))
			{
				$entity->setData($data->getData());
			}

			$this->entitySaver->save($entity);

			$result->setSubscription(
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
