<?php

class Aladham
{
    const API_URL = 'https://aladhan.com/prayer-times-api';
    private $token = "7734870499:AAHuLYnI2Ir_3j6cCyXdYSSGMuPjuIXUTBU";


    public function makeRequest($method, $data = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::API_URL . $this->token . '/' . $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }

    public function getPrayerTimes($latitude = 41.3775, $longitude = 64.5853, $method = 7)
    {
        $url = self::API_URL . "?latitude=" . $latitude . "&longitude=" . $longitude . "&method=" . $method;
        $response = $this->makeRequest($url);
        $data = json_decode($response, true);
        if ($data["status"] == 'success') {
            return $data["data"]['timings'];
        }
        return null;
    }
}


