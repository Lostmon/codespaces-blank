<?php

elgg_push_breadcrumb(elgg_echo('bojostube'), elgg_generate_url('collection:object:bojostube_video:all'));
elgg_push_breadcrumb(elgg_echo('add'));

$content = elgg_view_form('bojostube/video/add');

echo elgg_view_page(elgg_echo('Añadir vídeo'), [
    'content' => $content,
    'filter' => false,
]);
