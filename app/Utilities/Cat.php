<?php namespace App\Utilities;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{

    /*
     * 隨機貓貓圖
     */
    public static function random()
    {
        $username = env('PIXABAY_USERNAME');
        $key = env('PIXABAY_KEY');
        //檢查username與key
        if (empty($username) || empty($key)) {
            return null;
        }
        //抓取最新幾張圖，從中隨機（5-200）
        $number = 50;
        //API請求
        $client = new Client();
        $options = array(
            'username' => $username,
            'key' => $key,
            'image_type' => 'photo',
            'min_width' => '600',
            'q' => 'cute+cat',
            'per_page' => $number,
            'order' => 'latest'
        );
        $response = $client->get('http://pixabay.com/api', ['query' => $options]);
        $json = $response->json();
        return $json["hits"][rand(0, $number - 1)]["webformatURL"];
    }

}
