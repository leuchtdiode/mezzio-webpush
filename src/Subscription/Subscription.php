<?php
namespace Try2catch\WebPush\Subscription;

use Common\Dto\Dto;
use Common\Hydration\ArrayHydratable;
use Common\Hydration\ObjectToArrayHydratorProperty;
use DateTime;
use DateTimeInterface;
use Ramsey\Uuid\UuidInterface;

class Subscription implements Dto, ArrayHydratable
{
	public function __construct(
		private readonly UuidInterface $id,
		private readonly string $endpoint,
		private readonly ?string $name,
		private readonly array $data,
		private readonly DateTimeInterface $creationDate
	)
	{
	}

	#[ObjectToArrayHydratorProperty]
	public function getId(): UuidInterface
	{
		return $this->id;
	}

	#[ObjectToArrayHydratorProperty]
	public function getEndpoint(): string
	{
		return $this->endpoint;
	}

	#[ObjectToArrayHydratorProperty]
	public function getName(): ?string
	{
		return $this->name;
	}

	#[ObjectToArrayHydratorProperty]
	public function getData(): array
	{
		return $this->data;
	}

	#[ObjectToArrayHydratorProperty]
	public function getCreationDate(): DateTimeInterface
	{
		return $this->creationDate;
	}
}