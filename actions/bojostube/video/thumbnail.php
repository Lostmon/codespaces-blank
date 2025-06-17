<?php
// Acción para guardar miniatura personalizada
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
if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
    $filehandler = new ElggFile();
    $filehandler->owner_guid = $user->guid;
    $filehandler->setFilename("bojostube/thumbnail-{$video->guid}.jpg");
    $filehandler->open('write');
    $filehandler->write(file_get_contents($_FILES['thumbnail']['tmp_name']));
    $filehandler->close();
    $video->saveIconFromLocalFile($filehandler->getFilenameOnFilestore(), 'icon');
    return elgg_ok_response('', elgg_echo('Miniatura actualizada.'));
}
return elgg_error_response(elgg_echo('No se pudo subir la miniatura.'));
