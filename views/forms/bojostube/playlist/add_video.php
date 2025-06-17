<?php
// Formulario para agregar un video a una lista de reproducción
$user = elgg_get_logged_in_user_entity();
if (!$user) return;
$playlists = elgg_get_entities([
    'type' => 'object',
    'subtype' => 'bojostube_playlist',
    'owner_guid' => $user->guid,
    'limit' => 0,
]);
$video_guid = elgg_extract('video_guid', $vars);
echo elgg_view('input/hidden', ['name' => 'video_guid', 'value' => $video_guid]);
echo elgg_view('input/dropdown', [
    'name' => 'playlist_guid',
    'options_values' => array_column($playlists, 'title', 'guid'),
    'required' => true,
    'label' => elgg_echo('Selecciona una lista'),
]);
echo elgg_view('input/submit', ['value' => elgg_echo('Agregar a lista')]);
