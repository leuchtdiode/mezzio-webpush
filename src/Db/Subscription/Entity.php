<?php
namespace Try2catch\WebPush\Db\Subscription;

use Common\Db\Entity as DbEntity;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[ORM\Table(name: 'web_push_subscription')]
#[ORM\Entity(repositoryClass: Repository::class)]
class Entity implements DbEntity
{
	#[ORM\Id]
	#[ORM\Column(type: 'uuid', nullable: false)]
	private UuidInterface $id;

	#[ORM\Column(type: 'string', length: 500, nullable: false)]
	private string $endpoint;

	#[ORM\Column(type: 'string', length: 255, nullable: true)]
	private ?string $name = null;

	#[ORM\Column(type: 'json', nullable: false)]
	private array $data;

	#[ORM\Column(type: 'datetime', nullable: false)]
	private DateTime $creationDate;

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

	public function getEndpoint(): string
	{
		return $this->endpoint;
	}

	public function setEndpoint(string $endpoint): void
	{
		$this->endpoint = $endpoint;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setName(?string $name): void
	{
		$this->name = $name;
	}

	public function getData(): array
	{
		return $this->data;
	}

	public function setData(array $data): void
	{
		$this->data = $data;
	}

	public function getCreationDate(): DateTime
	{
		return $this->creationDate;
	}

	public function setCreationDate(DateTime $creationDate): void
	{
		$this->creationDate = $creationDate;
	}
}