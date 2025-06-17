<?php
/**
 * Move all blog icons to the new (default) location
 */

$request = elgg()->request;
$session = elgg_get_session();

$path = 'admin/upgrades/videolist_move_icons';
$completed = (bool) $request->getParam('upgrade_completed', false);
if ($completed) {
    $factory = new ElggUpgrade();
    $upgrade = $factory->getUpgradeFromPath($path);
    if (!empty($upgrade)) {
        $session->remove('videolist_move_icon_offset');
        $upgrade->setCompleted();
        return elgg_ok_response('', elgg_echo('Upgrade completado'));
    }
}

$error_offset = (int) $request->getParam('offset');
$start_offset = (int) $session->get('videolist_move_icon_offset', 0);
$offset = $error_offset + $start_offset;

$icon_sizes = elgg_get_icon_sizes('object', 'videolist_item');

$result = [
    'numSuccess' => 0,
    'numErrors' => 0,
];

$batch = new ElggBatch('elgg_get_entities', [
    'type' => 'object',
    'subtype' => 'videolist_item',
    'limit' => 10,
    'offset' => $offset,
]);
foreach ($batch as $entity) {
    $old_file = new ElggFile();
    $old_file->owner_guid = $entity->getOwnerGUID();
    $old_file->setFilename("videolist/{$entity->getGUID()}.jpg");
    if ((!$old_file->exists()) && ($entity->hasIcon('small'))) {
        $result['numSuccess']++;
        continue;
    }
    if ($entity->saveIconFromElggFile($old_file)) {
        $result['numSuccess']++;
        if ($old_file->exists()) {
            $old_file->delete();
        }
    } else {
        $result['numErrors']++;
    }
}
$session->set('videolist_move_icon_offset', ($start_offset + $result['numSuccess']));
echo json_encode($result);
