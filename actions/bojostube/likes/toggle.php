<?php
// Acción para alternar like/dislike en un video
$request = elgg()->request;
$user = elgg_get_logged_in_user_entity();
if (!$user) {
    return elgg_error_response(elgg_echo('Debes iniciar sesión.'));
}
$guid = (int) $request->getParam('guid');
$type = $request->getParam('type');
$video = get_entity($guid);
if (!$video) {
    return elgg_error_response(elgg_echo('Vídeo no encontrado.'));
}
if ($type === 'like') {
    // Elimina dislike si existe
    $video->deleteAnnotations('dislikes', $user->guid);
    // Alterna like
    if ($video->deleteAnnotations('likes', $user->guid)) {
        return elgg_ok_response('', elgg_echo('Like removido.'));
    } else {
        $video->annotate('likes', 1, ACCESS_PUBLIC, $user->guid);
        return elgg_ok_response('', elgg_echo('¡Te gusta este vídeo!'));
    }
} elseif ($type === 'dislike') {
    // Elimina like si existe
    $video->deleteAnnotations('likes', $user->guid);
    // Alterna dislike
    if ($video->deleteAnnotations('dislikes', $user->guid)) {
        return elgg_ok_response('', elgg_echo('Dislike removido.'));
    } else {
        $video->annotate('dislikes', 1, ACCESS_PUBLIC, $user->guid);
        return elgg_ok_response('', elgg_echo('No te gusta este vídeo.'));
    }
}
return elgg_error_response(elgg_echo('Acción no válida.'));
