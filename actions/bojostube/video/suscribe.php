<?php
$svc = elgg()->responseFactory;
$request = elgg()->request;

$channel_guid = (int) $request->getParam('channel_guid');
$user = elgg_get_logged_in_user_entity();

if ($user) {
    add_entity_relationship($user->guid, 'subscribed_to', $channel_guid);
    $svc->addSuccessMessage(elgg_echo('bojostube:subscribed'));
    return elgg_ok_response('', elgg_echo('bojostube:subscribed'));
} else {
    $svc->addErrorMessage(elgg_echo('bojostube:must_login'));
    return elgg_error_response(elgg_echo('bojostube:must_login'));
}