<?php
// Vista de analíticas básicas para un video
$video = elgg_extract('entity', $vars);
if (!$video) return;

$views = (int) $video->views_count;
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
$comments = elgg_get_entities([
    'type' => 'object',
    'subtype' => 'comment',
    'container_guid' => $video->guid,
    'limit' => 0,
]);

echo '<div class="bojostube-analytics">';
echo '<strong>' . elgg_echo('Vistas:') . '</strong> ' . $views . '<br>';
echo '<strong>' . elgg_echo('Likes:') . '</strong> ' . count($likes) . '<br>';
echo '<strong>' . elgg_echo('Dislikes:') . '</strong> ' . count($dislikes) . '<br>';
echo '<strong>' . elgg_echo('Comentarios:') . '</strong> ' . count($comments) . '<br>';
echo '</div>';
