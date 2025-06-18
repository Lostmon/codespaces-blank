<?php

elgg_gatekeeper();
$title = elgg_echo('simplevideos:add');

$form_vars = [
    'action' => elgg_generate_action_url('simplevideos/save'),
];
$body_vars = [];
$content = elgg_view_form('simplevideos/save', $form_vars, $body_vars);

$layout = elgg_view_layout('default', [
    'content' => $content,
    'title' => $title,
]);

echo elgg_view_page($title, $layout);
