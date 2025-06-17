<?php
// Sidebar básica
echo elgg_view('page/elements/comments_block', [
    'subtypes' => ['bojostube_video']
]);

echo elgg_view('page/elements/tagcloud_block', [
    'subtypes' => ['bojostube_video']
]);