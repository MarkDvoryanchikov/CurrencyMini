$(document).ready(function() {       
    getValute();
    var interval = $("#interval").val();
    timeToChange(interval);

    $("#interval").change(function(){
        interval = $(this).val();
        timeToChange(interval);
    });

    $("#update").click(function() {
        getValute();
        timeToChange(interval);
    });

});


var li;
function timeToChange(interval) {
    clearInterval(li);
    li = setInterval(function(){
        getValute();
    }, interval*1000*60);
}


function getValute() {
    $.getJSON("http://www.cbr-xml-daily.ru/daily_json.js", function(data) {
        $("#USD").text("USD Сегодня: " + data.Valute.USD.Value + 
                            " Вчера: " + data.Valute.USD.Previous);
        $("#EUR").text("EUR Сегодня: " + data.Valute.EUR.Value + 
                            " Вчера: " + data.Valute.EUR.Previous);
        var date = new Date();
        $("#time").text("Дата обновления: " + date.toLocaleString());
    });
}