<?php
// Acción para subir subtítulo a un video
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
if (isset($_FILES['subtitle']) && $_FILES['subtitle']['error'] === UPLOAD_ERR_OK) {
    $filehandler = new ElggFile();
    $filehandler->owner_guid = $user->guid;
    $filehandler->setFilename("bojostube/subtitle-{$video->guid}.vtt");
    $filehandler->open('write');
    $filehandler->write(file_get_contents($_FILES['subtitle']['tmp_name']));
    $filehandler->close();
    $video->subtitle_file = $filehandler->getFilenameOnFilestore();
    $video->save();
    return elgg_ok_response('', elgg_echo('Subtítulo guardado.'));
}
return elgg_error_response(elgg_echo('No se pudo subir el subtítulo.'));
