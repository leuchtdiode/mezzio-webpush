<?php
namespace Try2catch\WebPush;

use Doctrine\ORM\Mapping\Driver\AttributeDriver;

return [

	'console' => [
		'commands' => [
			Command\Tools\CreateKeys::class,
			Command\Notification\Send::class,
		],
	],

	'doctrine' => [
		'driver' => [
			'orm_default' => [
				'class' => AttributeDriver::class,
				'paths' => [ __DIR__ . '/../src' ],
			],
		],
	],

	'dependencies' => [
		'abstract_factories' => [
			DefaultFactory::class,
		],
	],
];
