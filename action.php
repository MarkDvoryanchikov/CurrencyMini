<?php
require "config.php";

$db = new PDO("mysql:dbname=$db_name;host=$db_host;port=$db_port", $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




if (isset($_POST['val']) && $_POST['command']=="add"){
    try {
        $q = $db->prepare("UPDATE valute SET active=1 WHERE pk_valute=(?);");
        $q->execute(array($_POST['val']));
    } catch (PDOException $e) {
        print "Не удалось добавить валюту для отслеживания: " . $e->getMessage();
    }
    dataForHTML($db);
}

if (isset($_POST['val']) && $_POST['command']=="del"){
    try {
        $q = $db->prepare("UPDATE valute SET active=0 WHERE pk_valute=(?);");
        $q->execute(array($_POST['val']));
    } catch (PDOException $e) {
        print "Не удалось убрать отслеживаемую валюту: " . $e->getMessage();
    }
    dataForHTML($db);
}

if ($_POST['command']=="update"){
    dataForHTML($db);
}


function dataForHTML($db) {
    $active = $db->query("SELECT * FROM valute WHERE active=1");
    foreach ($active as $value) {
        $mainarr[$value['pk_valute']] =
            [
                'pk_valute' => $value['pk_valute'],
                'valute_value' => $value['valute_value'],
                'previous' => $value['previous']
            ];
    }
    $active = $db->query("SELECT * FROM valute WHERE active=0");
    foreach ($active as $value) {
        $mainarr2[$value['pk_valute']] =
            [
                'pk_valute' => $value['pk_valute'],
                'name' => $value['name']
            ];
    }
    if (empty($mainarr)) $mainarr[] = "empty";
    if (empty($mainarr2)) $mainarr2[] = "empty";
    $data["data1"] = $mainarr;
    $data["data2"] = $mainarr2;
    print $data1 = json_encode($data, JSON_UNESCAPED_UNICODE);
}