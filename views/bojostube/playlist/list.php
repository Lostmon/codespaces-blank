<?php
// Vista de listas de reproducción del usuario
$user = elgg_get_logged_in_user_entity();
if (!$user) {
    echo elgg_echo('Debes iniciar sesión para ver tus listas.');
    return;
}

$playlists = elgg_get_entities([
    'type' => 'object',
    'subtype' => 'bojostube_playlist',
    'owner_guid' => $user->guid,
    'limit' => 0,
]);

echo '<h3>' . elgg_echo('Tus listas de reproducción') . '</h3>';
foreach ($playlists as $playlist) {
    echo elgg_view('bojostube/playlist/item', ['entity' => $playlist]);
}

echo elgg_view_form('bojostube/playlist/add');
