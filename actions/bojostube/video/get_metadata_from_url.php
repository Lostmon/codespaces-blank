<?php
$request = elgg()->request;

$url = $request->getParam('url', '', false);
$url = elgg_trigger_plugin_hook('videolist:preprocess', 'url', [], $url);

if (!$url) {
    return elgg_error_response(elgg_echo('videolist:error:no_url'));
}

$attributesPlatform = videolist_parse_url($url);

if (!$attributesPlatform) {
    return elgg_error_response(elgg_echo('videolist:error:invalid_url'));
}

list ($attributes, $platform) = $attributesPlatform;
/* @var Videolist_PlatformInterface $platform */
$platform_data = $platform->getData($attributes);
if (!$platform_data) {
    return elgg_error_response(elgg_echo('videolist:error:empty_provider_data'));
}

return elgg_ok_response([
    'title' => $platform_data['title'],
    'description' => $platform_data['description'],
]);
