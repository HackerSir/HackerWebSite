<?php namespace App\Utilities;

use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    //檢查網址是否為Youtube網址
    public static function isYoutube($url)
    {
        if (empty($url)) {
            return false;
        }
        $parseUrl = parse_url($url);
        if (!isset($parseUrl["host"])) {
            return false;
        }
        $host = $parseUrl["host"];
        if (strpos($host, 'youtube.com') !== false || strpos($host, 'youtu.be') !== false) {
            return true;
        }
        return false;
    }

    //透過網址取得Youtube video id
    public static function getVid($url)
    {
        if (!self::isYoutube($url)) {
            return null;
        }
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
        if (count($matches) >= 2) {
            return $matches[1];
        } else {
            return null;
        }
    }
}
