<?php

require "CbrHelper.php";
require "config.php";

$db = new PDO("mysql:host=$db_host;port=$db_port", $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Вариабельность названий
$db_name = "`".str_replace("`","``",$db_name)."`";

try {
    $db->query("CREATE DATABASE IF NOT EXISTS $db_name");
    $db->query("use $db_name");
    $q = $db->exec("CREATE TABLE IF NOT EXISTS valute (
                                pk_valute VARCHAR(5) NOT NULL  PRIMARY KEY,
                                date VARCHAR(100) NOT NULL,
                                previous_url VARCHAR(100) NOT NULL,
                                active VARCHAR(1) NOT NULL,
                                id VARCHAR(20) NOT NULL,
                                num_code DECIMAL NOT NULL,
                                nominal DECIMAL NOT NULL,
                                name VARCHAR(100) NOT NULL,
                                valute_value DECIMAL(8,4) NOT NULL,
                                previous DECIMAL(8,4) NOT NULL
    )");
} catch (PDOException $e) {
    print "Не удалось выполнить инициацию: " . $e->getMessage();
}


$iLoRo = CbrHelper::getJSON($url);
$arrayIn = array('Date','PreviousURL','CharCode','ID','NumCode','Nominal','Name','Value','Previous');
$arrayOut = CbrHelper::decodeJSON($iLoRo, $arrayIn);
$i = 2;

try {
    $count=$db->query("SELECT COUNT(*) as count FROM valute")->fetchColumn();
    if ($count == 0) {
        try {
            $db->exec("DELETE FROM valute");
        } catch (PDOException $e) {
            print "Чистка таблицы не удалась: " . $e->getMessage();
        }

        do {
            $j = $i + 1;
            $k = $i + 2;
            $l = $i + 3;
            $m = $i + 4;
            $n = $i + 5;
            $o = $i + 6;
            try {
                //                                     arr[$i] arr[0]     arr[1]          0       arr[i+1]    arr[i+2]    arr[i+3]  arr[i+4]    arr[i+5]      arr[i+6]
                $db->exec("INSERT INTO valute (`id`, `date`, `previous_url`, `active`, `num_code`, `pk_valute`, `nominal`, `name`, `valute_value`, `previous`)
                                            VALUES ('$arrayOut[$i]', '$arrayOut[0]','$arrayOut[1]', '0', '$arrayOut[$j]', '$arrayOut[$k]', '$arrayOut[$l]', '$arrayOut[$m]', '$arrayOut[$n]', '$arrayOut[$o]')");
            } catch (PDOException $e) {
                print "Не удалось заполнить таблицу валют: " . $e->getMessage();
            }
            $i += 7;
        } while ($i < count($arrayOut));

        try {
            $db->exec("UPDATE valute SET active=1 WHERE pk_valute='USD' OR pk_valute='EUR' OR pk_valute='JPY'");
        } catch (PDOException $e) {
            print "Не удалось задать валюты по умолчанию: " . $e->getMessage();
        }
    }
} catch (PDOException $e) {
    print "Не удалось выполнить начальное заполнение таблицы: " . $e->getMessage();
}
