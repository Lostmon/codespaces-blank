<?php
// Acción para crear una lista de reproducción
$request = elgg()->request;
$user = elgg_get_logged_in_user_entity();
if (!$user) {
    return elgg_error_response(elgg_echo('Debes iniciar sesión.'));
}
$title = $request->getParam('title');
if (!$title) {
    return elgg_error_response(elgg_echo('Falta el nombre de la lista.'));
}
$playlist = new ElggObject();
$playlist->subtype = 'bojostube_playlist';
$playlist->title = $title;
$playlist->owner_guid = $user->guid;
$playlist->container_guid = $user->guid;
if ($playlist->save()) {
    return elgg_ok_response('', elgg_echo('Lista creada.'), $playlist->getURL());
}
return elgg_error_response(elgg_echo('No se pudo crear la lista.'));
