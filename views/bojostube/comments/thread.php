<?php
// Vista de comentarios anidados para un video
$video = elgg_extract('entity', $vars);
if (!$video) {
    return;
}

$comments = elgg_get_entities([
    'type' => 'object',
    'subtype' => 'comment',
    'container_guid' => $video->guid,
    'limit' => 0,
    'order_by' => 'e.time_created ASC',
]);

foreach ($comments as $comment) {
    echo elgg_view('bojostube/comments/item', ['entity' => $comment]);
}

// Formulario para agregar comentario
if (elgg_is_logged_in()) {
    echo elgg_view_form('bojostube/comments/add', [
        'entity' => $video
    ]);
}
