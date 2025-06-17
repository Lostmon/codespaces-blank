<?php
// Formulario para reportar un video
$video_guid = elgg_extract('video_guid', $vars);
echo elgg_view('input/hidden', ['name' => 'video_guid', 'value' => $video_guid]);
echo elgg_view('input/text', [
    'name' => 'reason',
    'placeholder' => elgg_echo('Motivo del reporte'),
    'required' => true,
]);
echo elgg_view('input/longtext', [
    'name' => 'details',
    'placeholder' => elgg_echo('Detalles adicionales'),
]);
echo elgg_view('input/submit', ['value' => elgg_echo('Reportar')]);
