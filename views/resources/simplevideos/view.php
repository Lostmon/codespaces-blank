<?php

$guid = elgg_extract('guid', $vars);
$entity = get_entity($guid);
if (!$entity || $entity->getSubtype() !== 'simplevideo') {
    throw new \HttpException(elgg_echo('simplevideos:error:notfound'), 404);
}
$title = $entity->title;
$description = $entity->description;
$url = $entity->video_url;

function simplevideos_get_embed($url) {
    // YouTube
    if (preg_match('~(?:youtu.be/|youtube.com/(?:embed/|v/|watch\?v=))([\w-]{11})~', $url, $m)) {
        return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $m[1] . '" frameborder="0" allowfullscreen></iframe>';
    }
    // Vimeo
    if (preg_match('~vimeo.com/(\d+)~', $url, $m)) {
        return '<iframe src="https://player.vimeo.com/video/' . $m[1] . '" width="560" height="315" frameborder="0" allowfullscreen></iframe>';
    }
    // Otros servicios: agregar más aquí si se desea
    return elgg_echo('simplevideos:error:unsupported_url');
}

$embed = simplevideos_get_embed($url);

$content = "<h2>{$title}</h2>";
$content .= "<div>{$embed}</div>";
$content .= "<p>{$description}</p>";

$layout = elgg_view_layout('default', [
    'content' => $content,
    'title' => $title,
]);
echo elgg_view_page($title, $layout);
