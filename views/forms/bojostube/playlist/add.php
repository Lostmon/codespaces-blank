<?php
echo elgg_view('input/text', [
    'name' => 'title',
    'placeholder' => elgg_echo('Nombre de la lista'),
    'required' => true,
]);
echo elgg_view('input/submit', ['value' => elgg_echo('Crear lista')]);
