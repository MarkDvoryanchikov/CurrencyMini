<?php
require "config.php"; //Подключение конфига (айпи, порт, имя дб, пользователь, пароль)

$db = new PDO("mysql:dbname=$db_name;host=$db_host;port=$db_port", $db_user, $db_pass); //Подключение к бд
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Установка атрибутов объекту подключения

if (isset($_POST['command'])) { //Проверка, установлена ли переменная command
    switch ($_POST['command']): 
        case "add": //Добавление
            try {
                $q = $db->prepare("UPDATE valute SET active=1 WHERE pk_valute=(?);"); //Подготовка и выполнение sql запроса (active = 1 -> добавление в таблицу)
                $q->execute(array($_POST['val']));
            } catch (PDOException $e) {
                print "Не удалось добавить валюту для отслеживания: " . $e->getMessage(); //Сообщение об ошибке если будет вызвано какое-либо исключение
            }
            break;
        case "del": //Удаление
            try {
                $q = $db->prepare("UPDATE valute SET active=0 WHERE pk_valute=(?);"); //Подготовка и выполнение sql запроса (active = 0 -> удаление из таблицы)
                $q->execute(array($_POST['val']));
            } catch (PDOException $e) {
                print "Не удалось убрать отслеживаемую валюту: " . $e->getMessage(); //Сообщение об ошибке если будет вызвано какое-либо исключение
            }
            break;
    endswitch;
}
dataForHTML($db); //Вывод валют


function dataForHTML($db) {
    $active = $db->query("SELECT * FROM valute WHERE active=1"); //Выполнение запроса для получения валют добавленных в таблицу
    foreach ($active as $value) { //Ввод данных в массив
        $mainarr[$value['pk_valute']] =
            [
                'pk_valute' => $value['pk_valute'],
                'valute_value' => $value['valute_value'],
                'previous' => $value['previous']
            ];
    }
    $active = $db->query("SELECT * FROM valute WHERE active=0"); //Выполнение запроса для получения валют еще не добавленных в таблицу
    foreach ($active as $value) { //Ввод данных в массив
        $mainarr2[$value['pk_valute']] =
            [
                'pk_valute' => $value['pk_valute'],
                'name' => $value['name']
            ];
    }
    if (empty($mainarr)) $mainarr = "empty";
    if (empty($mainarr2)) $mainarr2 = "empty";
    $data["data1"] = $mainarr;
    $data["data2"] = $mainarr2;
    echo json_encode($data, JSON_UNESCAPED_UNICODE); //Вывод валют добавленных в таблицу
}