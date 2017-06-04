<?php

require "CbrHelper.php";


// Конфигурация
$db_host = 'localhost';
$db_port = '3306';
$db_name = "currency";
$db_user = 'mysql';
$db_pass = 'mysql';



$url = "http://www.cbr-xml-daily.ru/daily_json.js";

$db = new PDO("mysql:host=$db_host;port=$db_port", $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Вариабельность названий
$db_name = "`".str_replace("`","``",$db_name)."`";

try {
    $db->query("CREATE DATABASE IF NOT EXISTS $db_name");
    $db->query("use $db_name");
    $q = $db->exec("CREATE TABLE IF NOT EXISTS valute (
                                pk_valute VARCHAR(3) NOT NULL  PRIMARY KEY,
                                active VARCHAR(1) NOT NULL,
                                valute_value DECIMAL(6,4) NOT NULL,
                                previous DECIMAL(6,4) NOT NULL
    )");
} catch (PDOException $e) {
    print "Не удалось выполнить инициацию: " . $e->getMessage();
}





$iLoRo = CbrHelper::getJSON($url);
$arrayIn = array('CharCode','Value','Previous');
$arrayOut = CbrHelper::decodeJSON($iLoRo, $arrayIn);
$i = 0;
try {
    $q = $db->exec("DELETE FROM valute");
} catch (PDOException $e) {
    print "Чистка таблицы не удалась: " . $e->getMessage();
}
do {
    $j=$i+1; $k=$i+2;
    try {
        $q = $db->exec("INSERT INTO valute (`pk_valute`, `active`, `valute_value`, `previous`)
                                        VALUES ('$arrayOut[$i]', '0', '$arrayOut[$j]', '$arrayOut[$k]')");
    } catch (PDOException $e) {
        print "Не удалось заполнить таблицу валют: " . $e->getMessage();
    }
    $i+=3;
} while ($i < count($arrayOut));
// т.е. получается при обновлении стираются все сведения о выбранных отслеживаемых валютах.


try {
    $q = $db->exec("UPDATE valute SET active=1 WHERE pk_valute='USD' OR pk_valute='EUR'");
} catch (PDOException $e) {
    print "Не удалось задать валюты по умолчанию: " . $e->getMessage();
}


try {
    $activeNot = $db->query("SELECT * FROM valute WHERE active=0");
//    foreach ($activeNot as $value) {
//        echo  $value[pk_valute] . "<br/>";
//    }
} catch (PDOException $e) {
    print "Не удалось извлечь список неактивных валют: " . $e->getMessage();
}


try {
    $active = $db->query("SELECT * FROM valute WHERE active=1");
//    foreach ($active as $value) {
//        echo  $value[pk_valute] . " ". $value[active] ." ". $value[valute_value] ." ". $value[previous] . "<br/>";
//    }
} catch (PDOException $e) {
    print "Не удалось извлечь данные об отслеживаемых валютах: " . $e->getMessage();
}