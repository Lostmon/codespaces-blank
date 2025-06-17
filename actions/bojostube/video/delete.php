<?php
/**
* Elgg videolist item delete
* 
* @package ElggVideolist
*/

$svc = elgg()->responseFactory;
$request = elgg()->request;

$guid = (int) $request->getParam('guid');
$videolist_item = get_entity($guid);
if (!$videolist_item || !$videolist_item->guid) {
    $svc->addErrorMessage(elgg_echo('videolist:deletefailed'));
    return elgg_error_response(elgg_echo('videolist:deletefailed'));
}

if (!$videolist_item->canEdit()) {
    $svc->addErrorMessage(elgg_echo('videolist:deletefailed'));
    return elgg_error_response(elgg_echo('videolist:deletefailed'));
}

$container = $videolist_item->getContainerEntity();
$url = $videolist_item->getURL();

$thumbnail = "videolist/" . $videolist_item->guid . '.jpg';
$video_owner_guid = $videolist_item->getOwnerGUID();

if (!$videolist_item->delete()) {
    $svc->addErrorMessage(elgg_echo('videolist:deletefailed'));
    return elgg_error_response(elgg_echo('videolist:deletefailed'));
} else {
    $result = videolist_remove_thumbnails($thumbnail, $video_owner_guid);
    $svc->addSuccessMessage(elgg_echo('videolist:deleted'));
}

return elgg_ok_response('', elgg_echo('videolist:deleted'), elgg_generate_url('collection:object:bojostube_video:all'));
