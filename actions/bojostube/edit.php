<?php
/**
 * Create or edit a video
 *
 * @package ElggVideolist
 */

use Elgg\Exceptions\Http\BadRequestException;

$svc = elgg()->responseFactory;
$request = elgg()->request;
$config = elgg()->config;

$variables = $config->videolist ?? [];
$input = [];
foreach ($variables as $name => $type) {
    $should_filter_input = ($name !== 'video_url');
    $input[$name] = $request->getParam($name, null, $should_filter_input);
    if ($name == 'title') {
        $input[$name] = strip_tags($input[$name]);
    }
    if ($type == 'tags') {
        $input[$name] = string_to_tag_array($input[$name]);
    }
}

// Get guids
$video_guid = (int)$request->getParam('video_guid');
$container_guid = (int)$request->getParam('container_guid');

elgg()->stickyForms->make('videolist');

if (!$video_guid) {
    $input['video_url'] = elgg_trigger_plugin_hook('videolist:preprocess', 'url', $input, $input['video_url']);

    if (!$input['video_url']) {
        $svc->addErrorMessage(elgg_echo('videolist:error:no_url'));
        return elgg_error_response(elgg_echo('videolist:error:no_url'));
    }

    $attributesPlatform = videolist_parse_url($input['video_url']);

    if (!$attributesPlatform) {
        $svc->addErrorMessage(elgg_echo('videolist:error:invalid_url'));
        return elgg_error_response(elgg_echo('videolist:error:invalid_url'));
    }
    list ($attributes, $platform) = $attributesPlatform;
    /* @var Videolist_PlatformInterface $platform */

    $attributes = array_merge($attributes, $platform->getData($attributes));

    $input = array_merge($attributes, $input);
} else {
    unset($input['video_url']);
}

if ($video_guid) {
    $video = get_entity($video_guid);
    if (!$video || !$video->canEdit()) {
        $svc->addErrorMessage(elgg_echo('videolist:error:no_save'));
        return elgg_error_response(elgg_echo('videolist:error:no_save'));
    }
    $new_video = false;
} else {
    $video = new ElggObject();
    $video->subtype = 'videolist_item';
    $new_video = true;
}

if (sizeof($input) > 0) {
    foreach ($input as $name => $value) {
        $video->$name = $value;
    }
}

$video->container_guid = $container_guid;

if ($video->save()) {
    elgg()->stickyForms->clear('videolist');

    // Let's save the thumbnail in the data folder
    $thumb_url = $video->thumbnail;
    if ($thumb_url) {
        $thumbnail = file_get_contents($thumb_url);
        if ($thumbnail) {
            // write temporary file
            $prefix = "videolist/temp-" . $video->guid;
            $filehandler = new ElggFile();
            $filehandler->owner_guid = $video->owner_guid;
            $filehandler->setFilename($prefix . ".jpg");
            $filehandler->open("write");
            $filehandler->write($thumbnail);
            $video->saveIconFromLocalFile($filehandler->getFilenameOnFilestore(),'icon');
            $filehandler->close();
        }
    }

    $svc->addSuccessMessage(elgg_echo('videolist:saved'));

    if ($new_video) {
        elgg_create_river_item([
            'view' => 'river/object/videolist_item/create',
            'action_type' => 'create',
            'subject_guid' => elgg_get_logged_in_user_guid(),
            'object_guid' => $video->guid
        ]);
    }

    return elgg_ok_response('', elgg_echo('videolist:saved'), $video->getURL());
} else {
    $svc->addErrorMessage(elgg_echo('videolist:error:no_save'));
    return elgg_error_response(elgg_echo('videolist:error:no_save'));
}
