<?php
// Acción para marcar/desmarcar un video como favorito
$request = elgg()->request;
$user = elgg_get_logged_in_user_entity();
if (!$user) {
    return elgg_error_response(elgg_echo('Debes iniciar sesión.'));
}
$video_guid = (int) $request->getParam('video_guid');
$video = get_entity($video_guid);
if (!$video) {
    return elgg_error_response(elgg_echo('Vídeo no encontrado.'));
}
if (check_entity_relationship($user->guid, 'favorite_video', $video->guid)) {
    remove_entity_relationship($user->guid, 'favorite_video', $video->guid);
    return elgg_ok_response('', elgg_echo('Video removido de favoritos.'));
} else {
    add_entity_relationship($user->guid, 'favorite_video', $video->guid);
    return elgg_ok_response('', elgg_echo('Video añadido a favoritos.'));
}
