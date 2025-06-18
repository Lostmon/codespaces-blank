<?php
// Formulario para crear o editar un video
$video = elgg_extract('entity', $vars, null);
$title = $video ? $video->title : '';
$description = $video ? $video->description : '';
$video_url = $video ? $video->video_url : '';
$guid = $video ? $video->guid : null;

echo elgg_view('input/text', [
    'name' => 'title',
    'value' => $title,
    'label' => elgg_echo('bojostube:video:title'),
    'required' => true,
]);
echo elgg_view('input/url', [
    'name' => 'video_url',
    'value' => $video_url,
    'label' => elgg_echo('bojostube:video:url'),
    'required' => true,
]);
echo elgg_view('input/longtext', [
    'name' => 'description',
    'value' => $description,
    'label' => elgg_echo('bojostube:video:description'),
]);
if ($guid) {
    echo elgg_view('input/hidden', ['name' => 'guid', 'value' => $guid]);
}
echo elgg_view('input/submit', ['value' => elgg_echo('save')]);
