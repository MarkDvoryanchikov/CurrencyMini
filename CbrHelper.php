<?php

class CbrHelper {

    public static function getJSON($url) {
        //$c =curl_init('http://www.cbr-xml-daily.ru/daily_json.js');
        $c =curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $fact = curl_exec($c);
        return json_decode($fact,true);
    }

    public static function decodeJSON($json, $arrayIn) {
        $arrayOut = [];
        $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($json));
        foreach($iterator as $key => $value) {
            foreach ($arrayIn as $item) {
                if ($key==="$item"){
                    $arrayOut[] = $value;
                }
            }
        }
        return $arrayOut;
    }

}