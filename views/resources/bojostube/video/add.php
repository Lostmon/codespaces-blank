<?php
use Elgg\Exceptions\HttpException;

if (!elgg_is_logged_in()) {
    throw new HttpException(elgg_echo('actionunauthorized'), 403);
}

$title = elgg_echo('bojostube:add:video');
elgg_push_breadcrumb($title);

$form_vars = [
    'prevent_double_submit' => true,
    'enctype' => 'multipart/form-data'
];

$body_vars = [
    'title' => '',
    'description' => '',
    'video_url' => '',
    'access_id' => ACCESS_PUBLIC
];

$content = elgg_view_form('bojostube/video/save', $form_vars, $body_vars);

$layout = elgg_view_layout('default', [
    'title' => $title,
    'content' => $content,
    'sidebar' => elgg_view('bojostube/sidebar')
]);

echo elgg_view_page($title, $layout);