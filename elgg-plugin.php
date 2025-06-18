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
        'bojostube/video/save' => [],
        'bojostube/video/delete' => [],
        'bojostube/channel/subscribe' => [],
        'bojostube/channel/update' => []
    ],
'routes' => [
    // ... rutas existentes ...
    
    // Nueva ruta para listar todos los videos
    'collection:object:bojostube_video:all' => [
        'path' => '/bojostube/videos/all',
        'resource' => 'bojostube/video/all'
    ],
    
    // Ruta para el canal de usuario
    'view:object:bojostube_channel' => [
        'path' => '/bojostube/channel/{username}',
        'resource' => 'bojostube/channel/view',
        'defaults' => [
            'username' => elgg_get_logged_in_user_entity()->username
        ]
    ],
    
    // Ruta para añadir video
    'add:object:bojostube_video' => [
        'path' => '/bojostube/video/add',
        'resource' => 'bojostube/video/add',
        'middleware' => [
            \Elgg\Router\Middleware\Gatekeeper::class
        ]
    ]
],
	

	
	
	
    'view_extensions' => [
        'elgg.css' => [
            'bojostube/css' => []
        ]
    ]
];