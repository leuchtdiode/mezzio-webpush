<?php
namespace Try2catch\WebPush\Db\Notification;

use Common\Db\Entity as DbEntity;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Try2catch\WebPush\Db\Subscription\Entity as SubscriptionEntity;

#[ORM\Table(name: 'web_push_notification')]
#[ORM\Entity(repositoryClass: Repository::class)]
class Entity implements DbEntity
{
	#[ORM\Id]
	#[ORM\Column(type: 'uuid', nullable: false)]
	private UuidInterface $id;

	#[ORM\ManyToOne(targetEntity: SubscriptionEntity::class)]
	#[ORM\JoinColumn(name: 'subscription', nullable: false, onDelete: 'CASCADE')]
	private SubscriptionEntity $subscription;

	#[ORM\Column(type: 'json', nullable: false)]
	private array $payload;

	#[ORM\Column(type: 'datetime', nullable: false)]
	private DateTime $creationDate;

	#[ORM\Column(type: 'datetime', nullable: true)]
	private ?DateTime $sentAt = null;

	#[ORM\Column(type: 'string', length: 500, nullable: true)]
	private ?string $error = null;

	public function __construct()
	{
		$this->id           = Uuid::uuid4();
		$this->creationDate = new DateTime();
	}

	public function getId(): UuidInterface
	{
		return $this->id;
	}

	public function setId(UuidInterface $id): void
	{
		$this->id = $id;
	}

	public function getSubscription(): SubscriptionEntity
	{
		return $this->subscription;
	}

	public function setSubscription(SubscriptionEntity $subscription): void
	{
		$this->subscription = $subscription;
	}

	public function getPayload(): array
	{
		return $this->payload;
	}

	public function setPayload(array $payload): void
	{
		$this->payload = $payload;
	}

	public function getCreationDate(): DateTime
	{
		return $this->creationDate;
	}

	public function setCreationDate(DateTime $creationDate): void
	{
		$this->creationDate = $creationDate;
	}

	public function getSentAt(): ?DateTime
	{
		return $this->sentAt;
	}

	public function setSentAt(?DateTime $sentAt): void
	{
		$this->sentAt = $sentAt;
	}

	public function getError(): ?string
	{
		return $this->error;
	}

	public function setError(?string $error): void
	{
		$this->error = $error;
	}
}