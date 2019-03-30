<?php

return [
    [
        'class' => yii\rest\UrlRule::class,
        'pluralize' => false,
        'controller' => ['api/client'],
        'extraPatterns' => [
            'GET ' => 'list',
            'GET <id:\d+>' => 'item',
            'POST ' => 'create',
            'PUT,PATCH <id:\d+>' => 'update',
        ],
    ],
    [
        'class' => yii\rest\UrlRule::class,
        'pluralize' => false,
        'controller' => ['api/transfer'],
        'extraPatterns' => [
            'POST <id:\w+>' => 'debit',
            'POST ' => 'transaction',
        ],
    ],
    [
        'class' => yii\rest\UrlRule::class,
        'pluralize' => false,
        'controller' => ['api/currency'],
        'extraPatterns' => [
            'GET ' => 'list',
            'POST ' => 'update',
        ],
    ],
];