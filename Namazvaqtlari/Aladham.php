<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
class Aladham
{
    const API_URL = 'https://aladhan.com/prayer-times-api';
    private $token = "7734870499:AAHuLYnI2Ir_3j6cCyXdYSSGMuPjuIXUTBU";
    public $client;

    public function __construct(){
        $this->client = new Client([
            'base_uri' => self::API_URL,
            'timeout'  => 2.0,

        ]);
    }
    public function makeRequest($method, $data = [])
    {
        $response = $this->client->post($method, [
            'json' => $data,
        ]);
        return json_decode($response->getBody()->getContents());
    }

    public function getPrayerTimes($latitude = 41.3775, $longitude = 64.5853, $method = 7)
    {
        $apiUrl = "https://api.aladhan.com/v1/timingsByCity?city=Tashkent&country=Uzbekistan&method=2";
        $response = $this->client->get($apiUrl);
        $data =  json_decode($response->getBody(),true);
        return $data['data']['timings'] ?? null;
    }
}


