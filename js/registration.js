$(document).ready(function(){
    $("form").submit(function(event){
        event.preventDefault();
        //CHECKING      
        // var username = $('#username').val();
        // var password = $('#password2').val();
        // var email = $('#email').val();
        // var profile_image = $('#profile_image').val();
        // var promotion = $('#promotion').prop("checked");
        // alert(profile_image);

        //SEND TO SERVER
        $.ajax({
            url: "servlet/registration.php",
            method: "POST",
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function(res){
                res = JSON.parse(res);
                if(res['status'] === 'success'){
                    alert("Success!");
                    window.location.href = "index.php";
                }else{
                    alert("Fail! " + res['data']);
                }
            }
        });
    });

    $("#back").click(function(){
        window.location.href = "index.php";
    });
});

