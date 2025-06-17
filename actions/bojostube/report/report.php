<?php
// Acción para reportar un video
$request = elgg()->request;
$user = elgg_get_logged_in_user_entity();
if (!$user) {
    return elgg_error_response(elgg_echo('Debes iniciar sesión.'));
}
$video_guid = (int) $request->getParam('video_guid');
$reason = $request->getParam('reason');
$details = $request->getParam('details');
if (!$video_guid || !$reason) {
    return elgg_error_response(elgg_echo('Datos incompletos.'));
}
$report = new ElggObject();
$report->subtype = 'bojostube_report';
$report->owner_guid = $user->guid;
$report->container_guid = $video_guid;
$report->title = $reason;
$report->description = $details;
if ($report->save()) {
    return elgg_ok_response('', elgg_echo('Reporte enviado.'));
}
return elgg_error_response(elgg_echo('No se pudo enviar el reporte.'));
