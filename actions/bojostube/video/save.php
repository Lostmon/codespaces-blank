<?php

echo elgg_view('input/text', [
    'name' => 'title',
    'label' => elgg_echo('bojostube:video:title'),
    'required' => true,
]);

echo elgg_view('input/url', [
    'name' => 'video_url',
    'label' => elgg_echo('bojostube:video:url'),
    'required' => true,
]);

echo elgg_view('input/longtext', [
    'name' => 'description',
    'label' => elgg_echo('bojostube:video:description'),
]);

echo elgg_view('input/submit', ['value' => elgg_echo('save')]);
