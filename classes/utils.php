<?php
/**
 * @author @michyaraque
 */

interface Utilidades {
    public static function getUrl($string);
    public static function unshort($url);
}

class Utils implements Utilidades {

    /**
	 * @param  [string] 			$string
	 * @return [string]
	 */

    public static function getUrl($string) {
        preg_match('/(?<url>https?\:\/\/[^\" ]+)/i', $string, $matches);
        return $matches['url'];
    }

    /**
	 * @param  [string] 			$url
	 * @return [string]
	 */
    
    public static function unshort($url){
        $headers = @get_headers($url);
        $unshort_url = "";
        foreach ($headers as $h) {
            if (substr($h,0,10) == 'Location: ') {
                $unshort_url = trim(substr($h, 10));
                break;
            }
        }
        return $unshort_url;
    }
}
