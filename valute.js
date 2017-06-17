/*
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
*/

$(document).ready(function() {
    var date = new Date();
    $("#time").text(date.toLocaleString());

    getData();

    $('#add').click(function() {
        var val = $('#valutes').find('option:selected').val();
        if (val !== undefined)
            uploadPlease(val,"add");
    });

    $('#update').click(function() {
        getData();
    });


    //$('.delete-button').click(function() {
    $('body').on('click', '.delete-button', function(){
        var val = $(this).attr('name');
        uploadPlease(val,"del");
    });

});

function getData() {
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: { command: 'update'},
        dataType: 'json',
        success: function(data){
            var a = $("#valutes-info"),
                b = $("#valutes");
            a.empty();
            b.empty();
            if (data.data1 !== "empty"){
                for (var k in data.data1) {
                    a.append("<tr>" +
                        "<td>" + data.data1[k].pk_valute + "</td>" +
                        "<td>" + data.data1[k].valute_value + "</td>" +
                        "<td>" + data.data1[k].previous + "</td>" +
                        "<td><input class='btn btn-danger btn-xs delete-button'" +
                        "type='button' name=" + data.data1[k].pk_valute + " value='X'></td>" +
                        "</tr>");
                }
            }
            if (data.data2 !== "empty") {
                for (k in data.data2) {
                    b.append("<option value=" + data.data2[k].pk_valute + ">" + data.data2[k].pk_valute + " - " +
                        data.data2[k].name + "</option>")
                }
            }
            var date = new Date();
            $("#time").text(date.toLocaleString());
        }
    });
}

function uploadPlease(val,command) {

    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: { val : val, command: command},
        dataType: 'json',
        success: function(data){
            var a = $("#valutes-info"),
                b = $("#valutes");
            a.empty();
            b.empty();
            if (data.data1 !== "empty"){
                for (var k in data.data1) {
                    a.append("<tr>" +
                        "<td>" + data.data1[k].pk_valute + "</td>" +
                        "<td>" + data.data1[k].valute_value + "</td>" +
                        "<td>" + data.data1[k].previous + "</td>" +
                        "<td><input class='btn btn-danger btn-xs delete-button'" +
                        "type='button' name=" + data.data1[k].pk_valute + " value='X'></td>" +
                        "</tr>");
                }
            }
            if (data.data2 !== "empty") {
                for (k in data.data2) {
                    b.append("<option value=" + data.data2[k].pk_valute + ">" + data.data2[k].pk_valute + " - " +
                        data.data2[k].name + "</option>")
                }
            }
        }
    });
}
