<?php
echo elgg_view('input/file', [
    'name' => 'thumbnail',
    'accept' => 'image/*',
    'label' => elgg_echo('Subir miniatura personalizada'),
]);
echo elgg_view('input/submit', ['value' => elgg_echo('Guardar miniatura')]);
