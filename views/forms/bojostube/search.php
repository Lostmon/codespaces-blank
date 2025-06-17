<?php
echo elgg_view('input/text', [
    'name' => 'q',
    'placeholder' => elgg_echo('Buscar videos o canales...'),
]);
echo elgg_view('input/dropdown', [
    'name' => 'type',
    'options_values' => [
        'video' => elgg_echo('Videos'),
        'channel' => elgg_echo('Canales'),
    ],
    'value' => 'video',
]);
echo elgg_view('input/submit', ['value' => elgg_echo('Buscar')]);
