<?php

/**
 * @author Fachpersonal
 * @version 1.0
 */
class Request
{
    /**
     * Allows to make a GET Request, by parsing the url and data (if needed).
     *
     * @param string $url API URL
     * @param array $data Additional Data which are safed as POSTFIELDS, not always needed
     * @return array response as JSON Object
     */
    public static function get(string $url, array $data = []) : array
    {
        return self::call($url, Method::GET->name, $data);
    }
    /**
     * Allows to make a POST Request, by parsing the url and data (if needed).
     *
     * @param string $url API URL
     * @param array $data Additional Data which are safed as POSTFIELDS, not always needed
     * @return array response as JSON Object
     */
    public static function post(string $url, array $data = []) : array
    {
        return self::call($url, Method::POST->name, $data);
    }
    /**
     * Allows to make a PUT Request, by parsing the url and data (if needed).
     *
     * @param string $url API URL
     * @param array $data Additional Data which are safed as POSTFIELDS, not always needed
     * @return array response as JSON Object
     */
    public static function put(string $url, array $data = []) : array
    {
        return self::call($url, Method::PUT->name, $data);
    }
    /**
     * Allows to make a DELETE Request, by parsing the url and data (if needed).
     *
     * @param string $url API URL
     * @param array $data Additional Data which are safed as POSTFIELDS, not always needed
     * @return array response as JSON Object
     */
    public static function delete(string $url, array $data = []) : array
    {
        return self::call($url, Method::DELETE->name, $data);
    }

    /**
     * @param string $url API url
     * @param string $method Request method (GET/POST/PUT/DELETE)
     * @param array $data Additional Data if needed
     * @return array response as JSON Object
     */
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