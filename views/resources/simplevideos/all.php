<?php

$title = elgg_echo('simplevideos:all');
$content = elgg_list_entities([
    'type' => 'object',
    'subtype' => 'simplevideo',
    'no_results' => elgg_echo('simplevideos:no_videos'),
]);
$layout = elgg_view_layout('default', [
    'content' => $content,
    'title' => $title,
]);
echo elgg_view_page($title, $layout);
