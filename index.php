<?php require_once "init.php"; ?> //конструкция однократного включения файла


<!DOCTYPE html> //тип текущего документа: HTML 5, закрывающегося элемента нет
<html lang="ru"> //код языка для содержимого элемента
    <head> //тег хранения системной информации
        <meta charset="UTF-8"> //кодировка 
        <title>Курсы валют</title> //заголовок документа
        <link rel="stylesheet" href="main.css">
        <script type="text/javascript" src="jquery-3.1.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="main.css"> //подключения таблицы стилей CSS
        //страховка от случайного или умышленного повреждения или от подмены подключаемых файлов:
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script type="text/javascript" src="valute.js"></script> //подключение Javascript
    </head>
    <body> //область контента для страницы
        <div class="container"> //адаптивный контейнер фиксированной ширины
            <div id="content"> 

                <div class="valute"> //блоки
                    <div>
                        <label for="valutes">Добавить для отслеживания:</label> //надпись
                        <select class="form-control" id="valutes"> //раскрывающийся список


                        </select>
                        <input class="btn btn-success btn-block" id="add" type="button" value="Добавить"> //оформление кнопки
                    </div>
                    <div>
                        <label for="interval">Интервалы автообновления:</label> //выполнение отчета
                        <select class="form-control" id="interval">
                            <option value="5">5 минут</option>
                            <option value="10">10 минут</option>
                            <option value="30">30 минут</option>
                            <option value="60">60 минут</option>
                        </select>
                        <label for="update">Обновить вручную:</label>
                        <input  class="btn btn-success btn-block" id="update" type="button" value="Обновить"> 
                    </div>


                </div>
                <h3>Отслеживание курса валют:</h3> //заголовок 3-го уровня
                <div>
                    <table class="table"> // таблица
                        <thead> //шапка таблицы
                            <tr>
                                <th>Валюта</th>
                                <th>Цена (сегодня)</th>
                                <th>Цена (вчера)</th>
                                <th>Не отслеживать</th>
                            </tr>
                        </thead> //тело таблицы, что содержит информацию о валюте
                        <tbody id="valutes-info">



                        </tbody>
                    </table>
                </div>
                <div>Время последней синхронизации с сервером: <span id="time"></span> ; с cbr-xml-daily: </div> //получить курс валют с сайта центробанка
            </div>
        </div>
    </body>
</html>

