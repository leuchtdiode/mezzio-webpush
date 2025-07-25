<?php
declare(strict_types=1);

namespace Try2catch\WebPush\Db\Notification\Order;

use Common\Db\Order\AscOrDesc;

class CreationDate extends AscOrDesc
{
	protected function getField(): string
	{
		return 't.creationDate';
	}
}