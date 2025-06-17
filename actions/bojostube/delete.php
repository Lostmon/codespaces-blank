<?php

elgg_gatekeeper();

$request = elgg()->request;
$guid = $request->getParam('guid');
$video = get_entity($guid);

if (!$video instanceof ElggObject || $video->subtype !== 'bojostube_video') {
    return elgg_error_response(elgg_echo('Vídeo no válido'));
}

if (!$video->canEdit()) {
    return elgg_error_response(elgg_echo('No tienes permiso para eliminar este vídeo'));
}

if ($video->delete()) {
    return elgg_ok_response('', elgg_echo('Vídeo eliminado correctamente'), elgg_generate_url('collection:object:bojostube_video:all'));
}

return elgg_error_response(elgg_echo('Error al eliminar el vídeo'));
