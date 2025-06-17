<?php
// Formulario para agregar comentario o respuesta
$video = elgg_extract('entity', $vars);
$parent_guid = elgg_extract('parent_guid', $vars, null);

echo elgg_view('input/longtext', [
    'name' => 'description',
    'placeholder' => elgg_echo('Escribe un comentario...'),
]);
echo elgg_view('input/hidden', [
    'name' => 'container_guid',
    'value' => $parent_guid ?: $video->guid,
]);
echo elgg_view('input/submit', ['value' => elgg_echo('Comentar')]);
