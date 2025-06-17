<?php
namespace Bojosxtu\BojosTube;

class VideoService {
    public static function createVideo(\ElggUser $owner, array $data): \ElggObject {
        $video = new \ElggObject();
        $video->subtype = 'bojostube_video';
        $video->owner_guid = $owner->guid;
        $video->container_guid = $owner->guid;
        $video->access_id = $data['access_id'] ?? ACCESS_PUBLIC;
        
        $video->title = $data['title'];
        $video->description = $data['description'];
        $video->video_url = $data['video_url'];
        
        if (!$video->save()) {
            throw new \RuntimeException('Failed to save video');
        }
        
        return $video;
    }
    
    public static function getEmbedCode(string $url): string {
        // Lógica para generar código de inserción
        return '<iframe src="'.htmlspecialchars($url).'" width="100%" height="400" frameborder="0" allowfullscreen></iframe>';
    }
}