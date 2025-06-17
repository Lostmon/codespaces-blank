<?php
// Vista para que el admin vea los reportes de videos
if (!elgg_is_admin_logged_in()) {
    echo elgg_echo('Solo administradores pueden ver los reportes.');
    return;
}
$reports = elgg_get_entities([
    'type' => 'object',
    'subtype' => 'bojostube_report',
    'limit' => 0,
]);
echo '<h3>' . elgg_echo('Reportes de videos') . '</h3>';
foreach ($reports as $report) {
    $video = get_entity($report->container_guid);
    echo '<div class="bojostube-report">';
    echo '<strong>' . elgg_echo('Video:') . '</strong> ' . ($video ? $video->title : 'Desconocido') . '<br>';
    echo '<strong>' . elgg_echo('Motivo:') . '</strong> ' . $report->title . '<br>';
    echo '<strong>' . elgg_echo('Detalles:') . '</strong> ' . $report->description . '<br>';
    echo '<strong>' . elgg_echo('Reportado por:') . '</strong> ' . get_entity($report->owner_guid)->getDisplayName() . '<br>';
    echo '</div><hr>';
}
