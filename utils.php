<?php
interface Utilidades {
    public static function getUrl($string);
    public static function unshort($url);
}

class Utils implements Utilidades {

    public static function getUrl($string) {
        preg_match('/(?<url>https?\:\/\/[^\" ]+)/i', $string, $matches);
        return $matches['url'];
    }

    public static function unshort($url){
        $headers = @get_headers($url);
        $headers = json_encode($headers);
        if(!empty(preg_match('/Location:\s(?<site>[^"]+)/',  $headers, $match))) {
            $unshort_url = str_replace('\/', '/', $match['site']);
            return $unshort_url;
        }
    }
}