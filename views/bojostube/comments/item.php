<?php
// Vista de un comentario individual (soporta respuestas)
$comment = elgg_extract('entity', $vars);
if (!$comment) {
    return;
}

$user = $comment->getOwnerEntity();
echo '<div class="bojostube-comment">';
echo elgg_view_entity_icon($user, 'tiny');
echo '<strong>' . $user->getDisplayName() . '</strong>: ' . $comment->description;
echo '<div class="bojostube-comment-meta">';
echo elgg_view('output/url', [
    'text' => elgg_echo('reply'),
    'href' => false,
    'class' => 'bojostube-reply-link',
    'data-comment-guid' => $comment->guid
]);
echo '</div>';

// Respuestas anidadas
$replies = elgg_get_entities([
    'type' => 'object',
    'subtype' => 'comment',
    'container_guid' => $comment->guid,
    'limit' => 0,
]);
if ($replies) {
    echo '<div class="bojostube-comment-replies">';
    foreach ($replies as $reply) {
        echo elgg_view('bojostube/comments/item', ['entity' => $reply]);
    }
    echo '</div>';
}
echo '</div>';
