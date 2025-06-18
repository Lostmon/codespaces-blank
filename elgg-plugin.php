<?php
namespace Bojosxtu\BojosTube;

return [
    'plugin' => [
        'name' => 'BojosTube',
        'version' => '1.0.0',
        'activate_on_install' => true
    ],
    'entities' => [
        [
            'type' => 'object',
            'subtype' => 'bojostube_video',
            'class' => \ElggObject::class,
            'capabilities' => [
                'commentable' => true,
                'searchable' => true,
                'likable' => true
            ]
        ],
        [
            'type' => 'object',
            'subtype' => 'bojostube_channel',
            'class' => \ElggObject::class,
            'capabilities' => [
                'searchable' => true
            ]
        ]
    ],
    'actions' => [
        'bojostube/save' => [],
        'bojostube/video/save' => [],
        'bojostube/video/delete' => [],
        'bojostube/video/thumbnail' => [],
        'bojostube/video/subtitle' => [],
        'bojostube/playlist/add' => [],
        'bojostube/playlist/add_video' => [],
        'bojostube/playlist/favorite' => [],
        'bojostube/report/report' => [],
        'bojostube/comments/add' => [],
        'bojostube/likes/toggle' => [],
        'bojostube/suscribe' => [],
        'bojostube/get_metadata_from_url' => [],
    ],
    'routes' => [
        'collection:object:bojostube_video:all' => [
            'path' => '/bojostube/videos/all',
            'resource' => 'bojostube/video/all'
        ],
        'view:object:bojostube_channel' => [
            'path' => '/bojostube/channel/{username}',
            'resource' => 'bojostube/channel/view',
        ],
        'add:object:bojostube_video' => [
            'path' => '/bojostube/video/add',
            'resource' => 'bojostube/video/add',
            'middleware' => [
                \Elgg\Router\Middleware\Gatekeeper::class
            ]
        ],
        'edit:object:bojostube_video' => [
            'path' => '/bojostube/video/edit/{guid}',
            'resource' => 'bojostube/video/edit',
            'middleware' => [
                \Elgg\Router\Middleware\Gatekeeper::class
            ]
        ],
    ],
    'view_extensions' => [
        'elgg.css' => [
            'bojostube/css' => []
        ]
    ]
];