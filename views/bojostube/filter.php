<?php
// Filtro de navegación para Bojostube
$tabs = [
    'all' => [
        'text' => elgg_echo('all'),
        'href' => elgg_generate_url('collection:object:bojostube_video:all'),
        'selected' => true
    ],
    'popular' => [
        'text' => elgg_echo('bojostube:popular'),
        'href' => '#'
    ]
];
if (elgg_is_logged_in()) {
    $tabs['mine'] = [
        'text' => elgg_echo('mine'),
        'href' => '#'
    ];
}
echo elgg_view('navigation/tabs', ['tabs' => $tabs]);
