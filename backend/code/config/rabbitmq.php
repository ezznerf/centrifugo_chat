<?php
return[
    'default' => [
        'connection' => [
            'host' => env('RABBITMQ_HOST'),
            'port' => env('RABBITMQ_PORT'),
            'user' => env('RABBITMQ_USER'),
            'password' => env('RABBITMQ_PASSWORD'),
        ],
        'exchanges' => [
            1 => [
                'name' => 'main',
                'type' => 'direct',
            ]
        ],
        'queues' => [
            1 => [
                'name' => 'fast',
            ]
        ],
        'bindings' => [
            1 => [
                'queue' => 'fast',
                'exchange' => 'main',
                'routing_key' => 'email',
            ],
        ],
    ]
];

