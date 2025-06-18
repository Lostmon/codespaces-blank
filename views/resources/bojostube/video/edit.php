<?php
// Vista para editar un video
$guid = (int) get_input('guid');
$video = get_entity($guid);
if (!$video || $video->subtype !== 'bojostube_video' || !$video->canEdit()) {
    throw new \Elgg\Exceptions\Http\EntityNotFoundException();
}

$title = elgg_echo('bojostube:edit:video');
elgg_push_breadcrumb($title);

$form_vars = [
    'prevent_double_submit' => true,
    'enctype' => 'multipart/form-data',
    'action' => elgg_generate_action_url('bojostube/video/edit'),
];
$body_vars = [
    'entity' => $video
];

$content = elgg_view_form('bojostube/video/save', $form_vars, $body_vars);

$layout = elgg_view_layout('default', [
    'title' => $title,
    'content' => $content,
    'sidebar' => elgg_view('bojostube/sidebar')
]);

echo elgg_view_page($title, $layout);
