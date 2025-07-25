<?php
namespace Try2catch\WebPush\Subscription;

use Common\Dto\PatchModificationData;

class SaveData extends PatchModificationData
{
	const ENDPOINT = 'endpoint';
	const NAME     = 'name';
	const DATA     = 'data';

	private ?Subscription $subscription = null;
	private ?string       $endpoint     = null;
	private ?string       $name         = null;
	private ?array        $data         = null;

	public static function create(): self
	{
		return new self();
	}

	public function getSubscription(): ?Subscription
	{
		return $this->subscription;
	}

	public function setSubscription(?Subscription $subscription): SaveData
	{
		$this->subscription = $subscription;
		return $this;
	}

	public function getEndpoint(): ?string
	{
		return $this->endpoint;
	}

	public function setEndpoint(?string $endpoint): SaveData
	{
		$this->endpoint        = $endpoint;
		$this->modifications[] = self::ENDPOINT;
		return $this;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setName(?string $name): SaveData
	{
		$this->name            = $name;
		$this->modifications[] = self::NAME;
		return $this;
	}

	public function getData(): ?array
	{
		return $this->data;
	}

	public function setData(?array $data): SaveData
	{
		$this->data            = $data;
		$this->modifications[] = self::DATA;
		return $this;
	}
}