<?php
// Botones para compartir un video en redes sociales
$video = elgg_extract('entity', $vars);
if (!$video) return;
$url = $video->getURL();
$title = urlencode($video->title);
$share_url = urlencode($url);

echo '<div class="bojostube-social-share">';
echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $share_url . '" target="_blank">Facebook</a> | ';
echo '<a href="https://twitter.com/intent/tweet?url=' . $share_url . '&text=' . $title . '" target="_blank">Twitter</a> | ';
echo '<a href="https://wa.me/?text=' . $share_url . '" target="_blank">WhatsApp</a>';
echo '</div>';
