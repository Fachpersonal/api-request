<?php

class Request
{
    public static function get(string $url, array $data = []) : array
    {
        return self::call($url, Method::GET->name, $data);
    }
    public static function post(string $url, array $data = []) : array
    {
        return self::call($url, Method::POST->name, $data);
    }
    public static function put(string $url, array $data = []) : array
    {
        return self::call($url, Method::PUT->name, $data);
    }
    public static function delete(string $url, array $data = []) : array
    {
        return self::call($url, Method::DELETE->name, $data);
    }

    private static function call(string $url, string $method, array $data) : array{
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if($data != [])
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));

        $response = curl_exec($ch);

        return json_decode($response);
    }

}

enum Method {
    case GET;
    case POST;
    case PUT;
    case DELETE;
}