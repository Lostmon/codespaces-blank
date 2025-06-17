<?php
// Acción de búsqueda avanzada de videos y canales
$request = elgg()->request;
$q = $request->getParam('q');
$type = $request->getParam('type', 'video');
$options = [
    'limit' => 20,
    'order_by' => 'e.time_created DESC',
];
if ($type === 'video') {
    $options['type'] = 'object';
    $options['subtype'] = 'bojostube_video';
    $options['query'] = $q;
    $results = elgg_search($options);
    echo '<h3>' . elgg_echo('Resultados de videos') . '</h3>';
    foreach ($results['entities'] as $video) {
        echo elgg_view('object/bojostube_video', ['entity' => $video]);
    }
} else {
    $options['type'] = 'object';
    $options['subtype'] = 'bojostube_channel';
    $options['query'] = $q;
    $results = elgg_search($options);
    echo '<h3>' . elgg_echo('Resultados de canales') . '</h3>';
    foreach ($results['entities'] as $channel) {
        echo elgg_view('object/bojostube_channel', ['entity' => $channel]);
    }
}
