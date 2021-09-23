<?php

if(!function_exists('get_image_props')) {
    function get_image_props($images, $i) {
        $image = $images[$i];
        $id = $image['id'];
        $url = $image['url'];
        $caption = wp_get_attachment_caption( $id );
        
        return array (
            'id' => $id,
            'url' => $url,
            'caption' => $caption,
        );
    }
}