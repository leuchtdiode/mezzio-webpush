<?php
namespace Try2catch\WebPush\Notification;

use Common\Dto\Dto;
use Common\Hydration\ArrayHydratable;
use Common\Hydration\ObjectToArrayHydratorProperty;
use DateTime;
use Ramsey\Uuid\UuidInterface;
use Try2catch\WebPush\Subscription\Subscription;

class Notification implements Dto, ArrayHydratable
{
	public function __construct(
		private readonly UuidInterface $id,
		private readonly array $payload,
		private readonly DateTime $creationDate,
		private readonly ?DateTime $sentAt,
		private readonly ?string $error,
		private readonly ?Subscription $subscription
	)
	{
	}

	#[ObjectToArrayHydratorProperty]
	public function getId(): UuidInterface
	{
		return $this->id;
	}

	#[ObjectToArrayHydratorProperty]
	public function getPayload(): array
	{
		return $this->payload;
	}

	#[ObjectToArrayHydratorProperty]
	public function getCreationDate(): DateTime
	{
		return $this->creationDate;
	}

	#[ObjectToArrayHydratorProperty]
	public function getSentAt(): ?DateTime
	{
		return $this->sentAt;
	}

	#[ObjectToArrayHydratorProperty]
	public function getError(): ?string
	{
		return $this->error;
	}

	#[ObjectToArrayHydratorProperty]
	public function getSubscription(): ?Subscription
	{
		return $this->subscription;
	}
}