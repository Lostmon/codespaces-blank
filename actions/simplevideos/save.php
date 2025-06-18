<?php

elgg_gatekeeper();

$title = get_input('title');
$description = get_input('description');
$video_url = get_input('video_url');
$access_id = (int) get_input('access_id', ACCESS_DEFAULT);
$guid = get_input('guid');

if (!$title || !$video_url) {
    return elgg_error_response(elgg_echo('simplevideos:error:missing_fields'));
}

if ($guid) {
    $video = get_entity($guid);
    if (!$video || !$video->canEdit()) {
        return elgg_error_response(elgg_echo('simplevideos:error:no_edit_permission'));
    }
} else {
    $video = new ElggObject();
    $video->subtype = 'simplevideo';
    $video->owner_guid = elgg_get_logged_in_user_guid();
}

$video->title = $title;
$video->description = $description;
$video->video_url = $video_url;
$video->access_id = $access_id;

if (!$video->save()) {
    return elgg_error_response(elgg_echo('simplevideos:error:save'));
}

return elgg_ok_response('', elgg_echo('simplevideos:success:save'), $video->getURL());
