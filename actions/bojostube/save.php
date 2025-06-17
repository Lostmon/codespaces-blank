<?php

elgg_gatekeeper();

$request = elgg()->request;
$title = $request->getParam('title');
$description = $request->getParam('description');
$video_url = $request->getParam('video_url');
$guid = $request->getParam('guid');

if (!$title || !$video_url) {
    return elgg_error_response(elgg_echo('Missing title or video URL'));
}

$owner = elgg_get_logged_in_user_entity();

if ($guid) {
    $video = get_entity($guid);
    if (!$video || !$video instanceof ElggObject || $video->subtype !== 'bojostube_video') {
        return elgg_error_response(elgg_echo('Video no válido'));
    }
} else {
    $video = new ElggObject();
    $video->subtype = 'bojostube_video';
    $video->owner_guid = $owner->guid;
    $video->container_guid = $owner->guid;
    $video->access_id = ACCESS_PUBLIC;
}

$video->title = $title;
$video->description = $description;
$video->video_url = $video_url;

// Auto-generar embed HTML
$embed_code = '';
if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
    // YouTube
    if (preg_match('%(?:youtube\.com/watch\?v=|youtu\.be/)([^&]+)%', $video_url, $matches)) {
        $video_id = $matches[1];
        $embed_code = "<iframe width='560' height='315' src='https://www.youtube.com/embed/{$video_id}' frameborder='0' allowfullscreen></iframe>";
    }
} elseif (strpos($video_url, 'vimeo.com') !== false) {
    if (preg_match('%vimeo\.com/([0-9]+)%', $video_url, $matches)) {
        $video_id = $matches[1];
        $embed_code = "<iframe src='https://player.vimeo.com/video/{$video_id}' width='640' height='360' frameborder='0' allowfullscreen></iframe>";
    }
}

$video->embed_html = $embed_code;

if (!$video->save()) {
    return elgg_error_response(elgg_echo('No se pudo guardar el vídeo'));
}

return elgg_ok_response('', elgg_echo('Vídeo guardado correctamente'), elgg_generate_url('collection:object:bojostube_video:all'));
