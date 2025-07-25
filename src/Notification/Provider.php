<?php
namespace Try2catch\WebPush\Notification;

use Common\Db\EntityRepository;
use Common\Dto\CreateOptions;
use Common\Dto\FilterData;
use Common\Dto\Provider as CommonDtoProvider;
use Try2catch\WebPush\Db\Notification\Repository;
use Try2catch\WebPush\DtoMappingProvider;

/**
 * @method Notification|null byId($id, ?CreateOptions $createOptions = null)
 * @method Notification[] all(?CreateOptions $createOptions = null)
 * @method Notification[] filter(FilterData $filterData, ?CreateOptions $createOptions = null)
 */
class Provider extends CommonDtoProvider
{
	public function __construct(
		private readonly Repository $repository,
		private readonly DtoMappingProvider $dtoMappingProvider
	)
	{
	}

	protected function getRepository(): EntityRepository
	{
		return $this->repository;
	}

	protected function getDtoMapping(): Mapping
	{
		return $this->dtoMappingProvider->getNotificationMapping();
	}
}