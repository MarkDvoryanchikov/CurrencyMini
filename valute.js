$(document).ready(function() { 		// объявление функции ready на весь html doc
    var date = new Date();			// присваивание текущего времени к переменной date 	
    $("#time").text(date.toLocaleString());		//#

    uploadPlease("","update");		//# вызов функции

    $('#add').click(function() {	// объявление функции click на определенный элемент
        var val = $('#valutes').find('option:selected').val(); // парс данных со страницы 
        if (val !== undefined)	// условие на непустое значение
            uploadPlease(val,"add"); // вызов функции
    });

    $('#update').click(function() { // объявление функции click на определенный элемент
        uploadPlease("","update"); // вызов функции
    });


    $('body').on('click', '.delete-button', function(){ //объявление функции на тело html документа
        var val = $(this).attr('name');
        uploadPlease(val,"del");
    });

});


function uploadPlease(val,command) { //обновление значений
    $.ajax({ // парс данных и выполнение кода при успешном запросе
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
            var date = new Date();
            $("#time").text(date.toLocaleString());
        }
    });
}
