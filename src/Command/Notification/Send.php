<?php
declare(strict_types=1);

namespace Try2catch\WebPush\Command\Notification;

use Common\Db\FilterChain;
use Common\Db\OrderChain;
use Common\Dto\FilterData;
use Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Try2catch\WebPush\Command\Base;
use Try2catch\WebPush\Db\Notification\Filter as DbFilter;
use Try2catch\WebPush\Db\Notification\Order as DbOrder;
use Try2catch\WebPush\Notification\CreateOptions;
use Try2catch\WebPush\Notification\Provider as NotificationProvider;
use Try2catch\WebPush\Notification\Send\Sender;
use Try2catch\WebPush\Notification\Send\SendParams;

class Send extends Base
{
	public function __construct(
		private readonly NotificationProvider $notificationProvider,
		private readonly Sender $sender
	)
	{
		parent::__construct('web-push:notification:send');
	}

	protected function configure(): void
	{
		$this->setDescription('Sends unsent notifications');
	}

	/**
	 * @throws Exception
	 */
	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$notifications = $this->notificationProvider->filter(
			FilterData::create()
				->setFilterChain(
					FilterChain::create()
						->addFilter(
							DbFilter\SentAt::isNull()
						)
						->addFilter(
							DbFilter\Error::isNull()
						)
				)
				->setOrderChain(
					OrderChain::create()
						->addOrder(
							DbOrder\CreationDate::asc()
						)
				)
				->setOffset(0)
				->setLimit(20),
			CreateOptions::create()
				->setSubscription(true)
		);

		foreach ($notifications as $notification)
		{
			$this->sender->send(
				SendParams::create()
					->setNotification($notification)
			);
		}

		return self::SUCCESS;
	}
}
