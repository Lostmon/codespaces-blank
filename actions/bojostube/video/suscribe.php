<?php
$channel_guid = (int) get_input('channel_guid');
$user = elgg_get_logged_in_user_entity();

if ($user) {
    add_entity_relationship($user->guid, 'subscribed_to', $channel_guid);
    system_message('Subscribed!');
} else {
    register_error('Must be logged in');
}
forward(REFERER);