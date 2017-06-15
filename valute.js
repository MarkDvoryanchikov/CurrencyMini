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


    $('#add').click(function() {
        var val = $('#valutes').find('option:selected').val();
        uploadPlease(val,"add");
    });

    $('#update').click(function() {
    });


    //$('.delete-button').click(function() {
    $('body').on('click', '.delete-button', function(){
        var val = $(this).attr('name');
        uploadPlease(val,"del");
    });

});

function uploadPlease(val,command) {
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: { val : val, command: command},
        dataType: 'text',
        success: function(data){
            var result = $.parseJSON(data);
            var a = $("#valutes-info");
            a.empty();
            for(var k in result.data1) {
                a.append("<tr>"+
                    "<td>"+result.data1[k].pk_valute+"</td>"+
                    "<td>"+result.data1[k].valute_value+"</td>"+
                    "<td>"+result.data1[k].previous+"</td>"+
                    "<td><input class='btn btn-danger btn-xs delete-button'"+
                    "type='button' name="+result.data1[k].pk_valute+" value='X'></td>"+
                    "</tr>");
            }
            var b = $("#valutes");
            b.empty();
            for(var k in result.data2) {
                b.append("<option value="+result.data2[k].pk_valute+">"+ result.data2[k].pk_valute+" - "+
                    result.data2[k].name+"</option>")
            }
        }
    });
}
