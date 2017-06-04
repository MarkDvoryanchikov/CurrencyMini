<?php

class CbrHelper {



    public function getActive() {
        return "x";
    }

    public function getUnActive() {
        return "x";
    }

    public static function getJSON($url) {
        //$c =curl_init('http://www.cbr-xml-daily.ru/daily_json.js');
        $c =curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $fact = curl_exec($c);
        return json_decode($fact, true);
    }

    public function encodeJSON() {
        return "x";
    }

    public static function decodeJSON($json, $arrayIn) {
        //$arrayOut = [];
        //$arrayIn = array('CharCode','Value','Previous');
        //echo($json);

        $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($json));
        foreach($iterator as $key => $value) {
            foreach ($arrayIn as $item) {
                if ($key==="$item"){
                    //echo "<p>$key : $value</p>";
                    $arrayOut[] = $value;
                }
            }
        }
        //echo $arrayOut[1];

//        foreach($x["Valute"] as $key2 => $itemsItems){
//            foreach($itemsItems as $key => $value){
//                if ($k==="Value") echo "$key : $value\n";
//            }
//        }
        return $arrayOut;
    }

}