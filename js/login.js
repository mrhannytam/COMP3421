$(document).ready(function(){
    $('#loginform').submit(function(event){
        event.preventDefault();
        //CHECKING

        //SEND to servlet/login.php
        $.ajax({
            url: "servlet/login.php",
            method: "POST",
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function(res){
                res = JSON.parse(res);
                if(res['status'] === 'success'){
                    window.location.href = "index.php";
                }else{
                    alert("Fail! " + res['data']);
                }
            }
        });
    });
});