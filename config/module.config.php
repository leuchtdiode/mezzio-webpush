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
			'webpush_entities' => [
				'class' => AttributeDriver::class,
				'cache' => 'array',
				'paths' => [ __DIR__ . '/../src' ],
			],
			'orm_default'      => [
				'class'   => AttributeDriver::class,
				'drivers' => [
					'Try2catch\WebPush' => 'webpush_entities',
				],
			],
		],
	],

	'dependencies' => [
		'abstract_factories' => [
			DefaultFactory::class,
		],
	],
];
