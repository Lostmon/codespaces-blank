<?php
// Vista para mostrar subtítulos en el reproductor (HTML5)
$video = elgg_extract('entity', $vars);
if (!$video || !$video->subtitle_file) return;
$url = elgg_get_inline_url($video->subtitle_file);
echo '<track kind="subtitles" src="' . $url . '" srclang="es" label="Español" default>';
