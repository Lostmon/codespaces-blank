<?php
// Vista de un ítem de lista de reproducción
$playlist = elgg_extract('entity', $vars);
if (!$playlist) return;
echo '<div class="bojostube-playlist-item">';
echo '<strong>' . $playlist->title . '</strong> (' . $playlist->getTimeCreated() . ')';
echo elgg_view('output/url', [
    'text' => elgg_echo('Ver'),
    'href' => $playlist->getURL(),
]);
echo '</div>';
