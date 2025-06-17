<?php
$tabs = [
    'all' => [
        'text' => elgg_echo('all'),
        'href' => elgg_generate_url('collection:object:bojostube_video:all'),
        'selected' => true
    ],
    'popular' => [
        'text' => elgg_echo('bojostube:popular'),
        'href' => elgg_generate_url('collection:object:bojostube_video:popular')
    ]
];

if (elgg_is_logged_in()) {
    $tabs['mine'] = [
        'text' => elgg_echo('mine'),
        'href' => elgg_generate_url('collection:object:bojostube_video:owner')
    ];
}

echo elgg_view('navigation/tabs', ['tabs' => $tabs]);