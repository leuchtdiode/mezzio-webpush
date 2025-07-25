<?php
namespace Try2catch\WebPush\Notification;

use Common\Db\Entity as DbEntity;
use Common\Db\EntityRepository;
use Common\Dto\CreateOptions as CommonCreateOptions;
use Common\Dto\Dto;
use Common\Dto\Mapping as CommonMapping;
use Try2catch\WebPush\Db\Notification\Entity;
use Try2catch\WebPush\Db\Notification\Repository;
use Try2catch\WebPush\Subscription\Mapping as SubscriptionMapping;

/**
 * @method Entity getEntity(Dto $dto)
 */
class Mapping extends CommonMapping
{
	private SubscriptionMapping $subscriptionMapping;

	public function __construct(
		private readonly Repository $repository
	)
	{
	}

	public function setSubscriptionMapping(SubscriptionMapping $subscriptionMapping): void
	{
		$this->subscriptionMapping = $subscriptionMapping;
	}

	/**
	 * @param Entity $entity
	 * @param CreateOptions|null $createOptions
	 * @return Notification
	 */
	public function createSingle(DbEntity $entity, ?CommonCreateOptions $createOptions = null): Dto
	{
		return new Notification(
			$entity->getId(),
			$entity->getPayload(),
			$entity->getCreationDate(),
			$entity->getSentAt(),
			$entity->getError(),
			$createOptions && $createOptions->isSubscription()
				? $this->subscriptionMapping->createSingle($entity->getSubscription())
				: null
		);
	}

	protected function getRepository(): EntityRepository
	{
		return $this->repository;
	}
}