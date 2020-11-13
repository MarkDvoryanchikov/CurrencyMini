<?php

class CbrHelper { //Класс CbrHelper, содержащий в себе две public функции

    public static function getJSON($url) { //Функция извлечения JSON
        $c =curl_init('http://www.cbr-xml-daily.ru/daily_json.js'); //инициализация сеанса cURL по указанной ссылке в переменную $с
        //$c =curl_init($url); эта строка должна инициализировать сеанс cURL по ссылке, что передана в функцию, но изначально заккоментирована
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true); //возврат необработанного ответа с переменной c
        $fact = curl_exec($c); //выполнение запроса cURL
        return json_decode($fact,true); //декодирование строки и возврат переменной
    }

    public static function decodeJSON($json, $arrayIn) {//Функция декодирования json, на вход строка json и входной массив
        $arrayOut = []; //выходной массив
        $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($json)); //возвращение итератора для текущего элемента
        foreach($iterator as $key => $value) { //цикл по каждый value, выбирая key
            foreach ($arrayIn as $item) { //цикл по всем 'элементам входного массива
                if ($key==="$item"){ //сравнение key и элемента входного массива
                    $arrayOut[] = $value; //присваивание value
                }
            }
        }
        return $arrayOut; //возвращение выходного массива
    }


}