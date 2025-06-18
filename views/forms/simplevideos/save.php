<?php

$entity = elgg_extract('entity', $vars, null);
$title = $entity ? $entity->title : '';
$description = $entity ? $entity->description : '';
$url = $entity ? $entity->video_url : '';
$access_id = $entity ? $entity->access_id : ACCESS_DEFAULT;
$guid = $entity ? $entity->guid : null;

?>
<div>
    <label><?= elgg_echo('title') ?></label>
    <?= elgg_view('input/text', [
        'name' => 'title',
        'value' => $title,
        'required' => true,
    ]) ?>
</div>
<div>
    <label><?= elgg_echo('description') ?></label>
    <?= elgg_view('input/longtext', [
        'name' => 'description',
        'value' => $description,
    ]) ?>
</div>
<div>
    <label><?= elgg_echo('simplevideos:video_url') ?></label>
    <?= elgg_view('input/url', [
        'name' => 'video_url',
        'value' => $url,
        'required' => true,
    ]) ?>
</div>
<div>
    <label><?= elgg_echo('access') ?></label>
    <?= elgg_view('input/access', [
        'name' => 'access_id',
        'value' => $access_id,
    ]) ?>
</div>
<?php if ($guid): ?>
    <?= elgg_view('input/hidden', ['name' => 'guid', 'value' => $guid]) ?>
<?php endif; ?>
<div>
    <?= elgg_view('input/submit', ['value' => elgg_echo('save')]) ?>
</div>
