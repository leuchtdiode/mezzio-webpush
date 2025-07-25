<?php
declare(strict_types=1);

namespace Try2catch\WebPush\Notification\Send;

class SendResult
{
	private bool $success = false;
	private bool $expired = false;

	public function isSuccess(): bool
	{
		return $this->success;
	}

	public function setSuccess(bool $success): void
	{
		$this->success = $success;
	}

	public function isExpired(): bool
	{
		return $this->expired;
	}

	public function setExpired(bool $expired): void
	{
		$this->expired = $expired;
	}
}