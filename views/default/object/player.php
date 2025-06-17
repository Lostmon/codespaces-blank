<?php
$entity = elgg_extract('entity', $vars);

if (!$entity) {
    return;
}

$embed_code = Bojosxtu\BojosTube\VideoService::getEmbedCode($entity->video_url);

echo <<<HTML
<div class="bojostube-player">
    {$embed_code}
    <div class="bojostube-video-info">
        <h3>{$entity->title}</h3>
        <div class="elgg-subtext">
            {$entity->description}
        </div>
    </div>
</div>
HTML;