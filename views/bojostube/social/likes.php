<?php
// Vista de likes/dislikes para un video
$video = elgg_extract('entity', $vars);
if (!$video) {
    return;
}

$likes = elgg_get_annotations([
    'guid' => $video->guid,
    'annotation_name' => 'likes',
    'limit' => 0,
]);
$dislikes = elgg_get_annotations([
    'guid' => $video->guid,
    'annotation_name' => 'dislikes',
    'limit' => 0,
]);

$user = elgg_get_logged_in_user_entity();
$has_liked = $user ? elgg_get_annotation_from_id($video->guid, 'likes', $user->guid) : false;
$has_disliked = $user ? elgg_get_annotation_from_id($video->guid, 'dislikes', $user->guid) : false;

echo '<div class="bojostube-likes">';
echo elgg_view('output/url', [
    'text' => '👍 ' . count($likes),
    'href' => elgg_generate_action_url('bojostube/likes/toggle', ['guid' => $video->guid, 'type' => 'like']),
    'class' => $has_liked ? 'active' : '',
]);
echo elgg_view('output/url', [
    'text' => '👎 ' . count($dislikes),
    'href' => elgg_generate_action_url('bojostube/likes/toggle', ['guid' => $video->guid, 'type' => 'dislike']),
    'class' => $has_disliked ? 'active' : '',
]);
echo '</div>';
