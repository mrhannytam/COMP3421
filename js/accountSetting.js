$(document).ready(function(){

    $.ajax({
        url: "./servlet/getImage.php",
        method: "post",
        success: function(res){
            res = JSON.parse(res);
            if(res['status'] === 'success'){
                console.log(res['data']);
                $('#profile_image').attr("src", res['data'].substring(1));
            }            
        }
    });

    $.ajax({
        url: "./servlet/getAddress.php",
        method: "post",
        success: function(res){
            res = JSON.parse(res);
            if(res['status'] === 'success'){
                $('#address').val(res['data']);
            }            
        }
    });

    $('#image_form').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "./servlet/setImage.php",
            method: "POST",
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function(res){
                res = JSON.parse(res);
                if(res['status'] === 'success'){
                    $('#message').empty();
                    $('#message').append("<h1>Upload Image Success!</h1>");
                }else{
                    $('#message').empty();
                    $('#message').append("<h1>Upload Image Failed! " + res['data'] + "</h1>");
                }
            }
        });
    });

    $('#address_form').submit(function(e){
        e.preventDefault();
        var address = $('#address').val();

        $.ajax({
            url: "./servlet/setAddress.php",
            method: "post",
            data:{
                'address': address
            },
            success: function(res){
                res = JSON.parse(res);
                if(res['status'] === 'success'){
                    $('#message').empty();
                    $('#message').append("<h1>Update Address Success!</h1>");
                }else{
                    $('#message').empty();
                    $('#message').append("<h1>Update Address Failed! " + res['data'] + "</h1>");
                }
            }
        });
    });
    
});