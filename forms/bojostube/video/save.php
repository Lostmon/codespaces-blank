<?php
return [
    'plugin' => [
        'name' => 'VideoList',
        'version' => '1.0',
        'activate_on_install' => true
    ],
    'entities' => [
        [
            'type' => 'object',
            'subtype' => 'videolist',
            'class' => \ElggObject::class
        ],
        [
            'type' => 'object',
            'subtype' => 'videolist_channel',
            'class' => \ElggObject::class
        ]
    ],
    'routes' => [
        'view:object:videolist_channel' => [
            'path' => '/channel/{username}',
            'resource' => 'videolist/channel/view'
        ]
    ]
];