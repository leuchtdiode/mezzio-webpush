<?php
namespace Try2catch\WebPush\Subscription;

use Try2catch\WebPush\Db\Subscription\Deleter;
use Exception;
use Log\Log;
use Try2catch\WebPush\DtoMappingProvider;

class Remover
{
	public function __construct(
		private readonly Deleter $entityDeleter,
		private readonly DtoMappingProvider $dtoMappingProvider
	)
	{
	}

	public function remove(RemoveData $data): RemoveResult
	{
		$result = new RemoveResult();
		$result->setSuccess(false);

		try
		{
			$this->entityDeleter->delete(
				$this->dtoMappingProvider
					->getSubscriptionMapping()
					->getEntity($data->getSubscription())
			);

			$result->setSuccess(true);
		}
		catch (Exception $ex)
		{
			Log::error($ex);
		}

		return $result;
	}
}