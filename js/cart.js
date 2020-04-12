$(document).ready(function(){
    console.log("HI FROM cart");
    var id = document.cookie;
    console.log(id);
    $.ajax({
        url: "servlet/getCart.php",
        method: "post",
        success: function(res){
            res = JSON.parse(res);
            if(res['status'] === "success"){
                console.log(res['data']);
            }else{
                alert("Register first :)");
            }
        }
    });
    $('#login-register').click(function(){
        window.location.href = "login.php";
    });

    $('#shopping').click(function(){
        window.location.href = "index.php";
    });
});