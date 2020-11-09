<?php

class CbrHelper { //this is class that called cbrhelper

    public static function getJSON($url) { //this is function that called getJSON
        $c =curl_init('http://www.cbr-xml-daily.ru/daily_json.js'); //присвоить пременную
        //$c =curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true); //функция
        $fact = curl_exec($c); //переменная
        return json_decode($fact,true); //возвращение 
    }

    public static function decodeJSON($json, $arrayIn) {
        $arrayOut = []; //массив
        $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($json));
        foreach($iterator as $key => $value) { //цикл
            foreach ($arrayIn as $item) { //цикл в цикле
                if ($key==="$item"){ //условие
                    $arrayOut[] = $value;
                }
            }
        }
        return $arrayOut; //возвращение
    }


}