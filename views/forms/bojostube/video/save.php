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
    ],
    'forms' => [
        'videolist/save' => [
            'title' => elgg_echo('bojostube:video:title'),
            'description' => elgg_echo('bojostube:video:description'),
            'video_url' => elgg_echo('bojostube:video:url'),
            'guid' => null,
        ],
    ],
    'views' => [
        'input/text' => [
            'label' => elgg_echo('bojostube:video:title'),
            'required' => true,
        ],
        'input/url' => [
            'label' => elgg_echo('bojostube:video:url'),
            'required' => true,
        ],
        'input/longtext' => [
            'label' => elgg_echo('bojostube:video:description'),
        ],
        'input/hidden' => [],
        'input/submit' => [
            'value' => elgg_echo('save'),
        ],
    ],
];