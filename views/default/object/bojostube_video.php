<?php

$entity = elgg_extract('entity', $vars);
if (!$entity instanceof ElggEntity || !$entity->video_url) {
    echo elgg_echo("bojostube:missing_video");
    return;
}

$video_url = $entity->video_url;

// Función para generar el embed automáticamente
function get_embed_code($url) {
    if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
        preg_match("/(youtu.be\/|v=)([^&]+)/", $url, $matches);
        $video_id = $matches[2] ?? '';
        if ($video_id) {
            return "<iframe width='100%' height='400' src='https://www.youtube.com/embed/{$video_id}' frameborder='0' allowfullscreen></iframe>";
        }
    }

    if (strpos($url, 'vimeo.com') !== false) {
        preg_match("/vimeo.com\/(\d+)/", $url, $matches);
        $video_id = $matches[1] ?? '';
        if ($video_id) {
            return "<iframe src='https://player.vimeo.com/video/{$video_id}' width='100%' height='400' frameborder='0' allowfullscreen></iframe>";
        }
    }

    return "<p>Este tipo de enlace aún no es compatible para mostrar vídeo.</p>";
}

?>

<div class="bojostube-video-player">
    <?= get_embed_code($video_url) ?>
</div>

<div class="bojostube-video-info">
    <h2><?= htmlspecialchars($entity->title) ?></h2>
    <p><?= elgg_view("output/longtext", ["value" => $entity->description]) ?></p>
    <p><strong>Subido por:</strong> <?= elgg_view("output/url", ["entity" => $entity->getOwnerEntity()]) ?></p>
    <p><strong>Fecha:</strong> <?= date("d/m/Y", $entity->time_created) ?></p>
</div>
