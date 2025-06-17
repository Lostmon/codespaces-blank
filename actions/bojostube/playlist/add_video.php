<?php
// Acción para agregar un video a una lista de reproducción
$request = elgg()->request;
$user = elgg_get_logged_in_user_entity();
if (!$user) {
    return elgg_error_response(elgg_echo('Debes iniciar sesión.'));
}
$video_guid = (int) $request->getParam('video_guid');
$playlist_guid = (int) $request->getParam('playlist_guid');
$video = get_entity($video_guid);
$playlist = get_entity($playlist_guid);
if (!$video || !$playlist) {
    return elgg_error_response(elgg_echo('Datos inválidos.'));
}
if (!check_entity_relationship($playlist->guid, 'has_video', $video->guid)) {
    add_entity_relationship($playlist->guid, 'has_video', $video->guid);
}
return elgg_ok_response('', elgg_echo('Video agregado a la lista.'));
