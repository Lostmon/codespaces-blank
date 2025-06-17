<?php
// Vista de videos favoritos del usuario
$user = elgg_get_logged_in_user_entity();
if (!$user) return;
$favorites = elgg_get_entities_from_relationship([
    'relationship' => 'favorite_video',
    'relationship_guid' => $user->guid,
    'type' => 'object',
    'subtype' => 'bojostube_video',
    'limit' => 0,
]);
echo '<h3>' . elgg_echo('Tus videos favoritos') . '</h3>';
foreach ($favorites as $video) {
    echo elgg_view('object/bojostube_video', ['entity' => $video]);
}
