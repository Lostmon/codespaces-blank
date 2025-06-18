<?php

elgg_gatekeeper();
$guid = elgg_extract('guid', $vars);
$entity = get_entity($guid);
if (!$entity || !$entity->canEdit()) {
    throw new \HttpException(elgg_echo('simplevideos:error:no_edit_permission'), 403);
}
$title = elgg_echo('simplevideos:edit');
$form_vars = [
    'action' => elgg_generate_action_url('simplevideos/save'),
];
$body_vars = ['entity' => $entity];
$content = elgg_view_form('simplevideos/save', $form_vars, $body_vars);
$layout = elgg_view_layout('default', [
    'content' => $content,
    'title' => $title,
]);
echo elgg_view_page($title, $layout);
