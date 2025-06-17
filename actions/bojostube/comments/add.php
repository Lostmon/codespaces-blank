<?php
// Acción para guardar comentario o respuesta anidada
$request = elgg()->request;
$user = elgg_get_logged_in_user_entity();
if (!$user) {
    return elgg_error_response(elgg_echo('Debes iniciar sesión para comentar.'));
}
$description = $request->getParam('description');
$container_guid = (int) $request->getParam('container_guid');
if (!$description || !$container_guid) {
    return elgg_error_response(elgg_echo('Faltan datos.'));
}
$comment = new ElggComment();
$comment->description = $description;
$comment->container_guid = $container_guid;
$comment->owner_guid = $user->guid;
if ($comment->save()) {
    return elgg_ok_response('', elgg_echo('Comentario publicado.'));
}
return elgg_error_response(elgg_echo('No se pudo guardar el comentario.'));
