<?php
declare(strict_types=1);

namespace Try2catch\WebPush\Command\Tools;

use ErrorException;
use Minishlink\WebPush\VAPID;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Try2catch\WebPush\Command\Base;

class CreateKeys extends Base
{
	public function __construct()
	{
		parent::__construct('web-push:tools:create-keys');
	}

	protected function configure(): void
	{
		$this->setDescription('Generate private and public key');
	}

	/**
	 * @throws ErrorException
	 */
	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$keys = VAPID::createVapidKeys();

		$output->writeln('Public key: ' . $keys['publicKey']);
		$output->writeln('Private key: ' . $keys['privateKey']);

		return self::SUCCESS;
	}
}
