<?php
echo elgg_view('input/file', [
    'name' => 'subtitle',
    'accept' => '.vtt,.srt',
    'label' => elgg_echo('Subir subtítulo (.vtt o .srt)'),
]);
echo elgg_view('input/submit', ['value' => elgg_echo('Guardar subtítulo')]);
