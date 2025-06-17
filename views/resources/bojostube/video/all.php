<?php
elgg_push_context('bojostube');
$title = elgg_echo('bojostube:all:videos');

// Contenido principal - Lista de videos
$content = elgg_list_entities([
    'type' => 'object',
    'subtype' => 'bojostube_video',
    'no_results' => elgg_echo('bojostube:no:videos'),
    'order_by' => 'e.time_created DESC',
    'limit' => 12
]);

// Layout
$layout = elgg_view_layout('default', [
    'title' => $title,
    'content' => $content,
    'sidebar' => elgg_view('bojostube/sidebar'),
    'filter' => elgg_view('bojostube/filter')
]);

echo elgg_view_page($title, $layout);
elgg_pop_context();