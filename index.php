<?php require_once "init.php"; ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Курсы валют</title>
        <link rel="stylesheet" href="main.css">
        <script type="text/javascript" src="jquery-3.1.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="main.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script type="text/javascript" src="valute.js"></script>
    </head>
    <body>
        <div class="container">
            <div id="content">

                <div class="valute">
                    <div>
                        <label for="valutes">Добавить для отслеживания:</label>
                        <select class="form-control" id="valutes">

<?php foreach ($activeNot as $value) : ?>
                            <option value='<?php echo $value['pk_valute'] ?>'><?php echo $value['pk_valute']." - ".$value['name'] ?></option>
<?php endforeach; ?>

                        </select>
                        <input class="btn btn-success btn-block" id="add" type="button" value="Добавить">
                    </div>
                    <div>
                        <label for="interval">Интервалы автообновления:</label>
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
                <h3>Отслеживание курса валют:</h3>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Валюта</th>
                                <th>Цена (сегодня)</th>
                                <th>Цена (вчера)</th>
                                <th>Не отслеживать</th>
                            </tr>
                        </thead>
                        <tbody id="valutes-info">

<?php foreach ($active as $value) : ?>
                            <tr>
                                <td><?php echo "$value[pk_valute]" ?></td>
                                <td><?php echo "$value[valute_value]" ?></td>
                                <td><?php echo "$value[previous]" ?></td>
                                <td>
                                    <input class="btn btn-danger btn-xs delete-button" type='button' name='<?php echo "$value[pk_valute]" ?>' value='X'>
                                </td>
                            </tr>
<?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

                <div>Время последней синхронизации с сервером: <span id="time"></span> ; с cbr-xml-daily: </div>
            </div>
        </div>
    </body>
</html>

