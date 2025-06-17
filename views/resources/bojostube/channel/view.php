<?php
$username = elgg_extract('username', $vars);
$user = get_user_by_username($username);

if (!$user) {
    throw new \Elgg\EntityNotFoundException();
}

$title = elgg_echo('bojostube:channel:title', [$user->getDisplayName()]);

// Listar videos del usuario
$content = elgg_list_entities([
    'type' => 'object',
    'subtype' => 'bojostube_video',
    'owner_guid' => $user->guid,
    'no_results' => elgg_echo('bojostube:no:videos')
]);

$layout = elgg_view_layout('default', [
    'title' => $title,
    'content' => $content,
    'sidebar' => elgg_view('bojostube/sidebar', [
        'user' => $user
    ])
]);

echo elgg_view_page($title, $layout);