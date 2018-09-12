<?php

class RMLP_Utility {
   
    public static function update_post_meta($post_id, $meta_key, $meta_value) {
        $meta_key = RMLP_META_PREFIX . $meta_key;
        update_post_meta($post_id, $meta_key, $meta_value);
    }
    
    public static function get_post_meta($post_id, $key = '', $single = false) {
        if (!empty($key))
            $key = RMLP_META_PREFIX . $key;

        $value = get_post_meta($post_id, $key, $single);

        return $value;
    }
    
    public static function HTMLToRGB($htmlCode) {
   
        if ($htmlCode[0] == '#')
            $htmlCode = substr($htmlCode, 1);

        if (strlen($htmlCode) == 3) {
            $htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
        }

        $r = hexdec($htmlCode[0] . $htmlCode[1]);
        $g = hexdec($htmlCode[2] . $htmlCode[3]);
        $b = hexdec($htmlCode[4] . $htmlCode[5]);

        $rgb = array($r, $g, $b);
        return $rgb;
    }
}
