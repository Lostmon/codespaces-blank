<?php

elgg_gatekeeper();

$username = get_input('username');
$user = get_user_by_username($username);

if (!$user) {
    return elgg_error_response(elgg_echo('Usuario no encontrado'));
}

$viewer = elgg_get_logged_in_user_entity();

if ($viewer->guid === $user->guid) {
    return elgg_error_response(elgg_echo('No puedes suscribirte a ti mismo'));
}

// Evita duplicados
if (check_entity_relationship($viewer->guid, 'subscribed_to', $user->guid)) {
    return elgg_error_response(elgg_echo('Ya estás suscrito'));
}

add_entity_relationship($viewer->guid, 'subscribed_to', $user->guid);

return elgg_ok_response('', elgg_echo('Suscripción realizada'), elgg_generate_url('view:object:bojostube_channel', ['username' => $user->username]));
