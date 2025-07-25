<?php
declare(strict_types=1);

namespace Try2catch\WebPush\Notification;

use Common\Dto\PatchModificationData;
use DateTime;
use Try2catch\WebPush\Subscription\Subscription;

class SaveData extends PatchModificationData
{
	const SUBSCRIPTION = 'subscription';
	const PAYLOAD      = 'payload';
	const SENT_AT      = 'sentAt';
	const ERROR        = 'error';

	private ?Notification $notification = null;

	private ?Subscription $subscription = null;
	private ?array        $payload      = null;
	private ?DateTime     $sentAt       = null;
	private ?string       $error        = null;

	public static function create(): self
	{
		return new self();
	}

	public function getNotification(): ?Notification
	{
		return $this->notification;
	}

	public function setNotification(?Notification $notification): SaveData
	{
		$this->notification = $notification;
		return $this;
	}

	public function getSubscription(): ?Subscription
	{
		return $this->subscription;
	}

	public function setSubscription(?Subscription $subscription): SaveData
	{
		$this->subscription    = $subscription;
		$this->modifications[] = self::SUBSCRIPTION;
		return $this;
	}

	public function getPayload(): ?array
	{
		return $this->payload;
	}

	public function setPayload(?array $payload): SaveData
	{
		$this->payload         = $payload;
		$this->modifications[] = self::PAYLOAD;
		return $this;
	}

	public function getSentAt(): ?DateTime
	{
		return $this->sentAt;
	}

	public function setSentAt(?DateTime $sentAt): SaveData
	{
		$this->sentAt          = $sentAt;
		$this->modifications[] = self::SENT_AT;
		return $this;
	}

	public function getError(): ?string
	{
		return $this->error;
	}

	public function setError(?string $error): SaveData
	{
		$this->error           = $error;
		$this->modifications[] = self::ERROR;
		return $this;
	}
}