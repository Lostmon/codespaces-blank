<?php
$title = elgg_echo('bojostube:all:videos');

// Listar todos los videos
$content = elgg_list_entities([
    'type' => 'object',
    'subtype' => 'bojostube_video',
    'no_results' => elgg_echo('bojostube:no:videos')
]);

// Botón para añadir nuevo video
if (elgg_is_logged_in()) {
    $add_link = elgg_view('output/url', [
        'text' => elgg_echo('bojostube:add:video'),
        'href' => elgg_generate_url('add:object:bojostube_video'),
        'class' => 'elgg-button elgg-button-action'
    ]);
    $content = $add_link . $content;
}

$layout = elgg_view_layout('default', [
    'title' => $title,
    'content' => $content,
    'sidebar' => elgg_view('bojostube/sidebar')
]);

echo elgg_view_page($title, $layout);