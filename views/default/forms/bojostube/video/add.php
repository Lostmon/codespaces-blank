<?php

$title = elgg_extract('title', $vars, '');
$description = elgg_extract('description', $vars, '');
$video_url = elgg_extract('video_url', $vars, '');
$guid = elgg_extract('guid', $vars, null);

echo elgg_view('input/text', [
    'name' => 'title',
    'value' => $title,
    'placeholder' => 'Título del vídeo',
    'required' => true,
]);

echo elgg_view('input/longtext', [
    'name' => 'description',
    'value' => $description,
    'placeholder' => 'Descripción del vídeo',
]);

echo elgg_view('input/text', [
    'name' => 'video_url',
    'value' => $video_url,
    'placeholder' => 'Pega el enlace de YouTube, Vimeo, etc.',
    'required' => true,
]);

if ($guid) {
    echo elgg_view('input/hidden', ['name' => 'guid', 'value' => $guid]);
}

echo elgg_view('input/submit', ['value' => 'Guardar vídeo']);
