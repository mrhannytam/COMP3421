$(document).ready(function(){
    $('#button-group').hide();


    $.when(ajax1()).done(function(){  //RUN AFTER RECEIVING RESULT FROM AJAX1, otherwise the function dont work properly

        $('.delete').click(function(){
            var inventory_id = $(this).attr('id');

            $.ajax({
                url: "./servlet/deleteOneCart.php",
                method: "POST",
                data: {
                    "inventory_id": inventory_id
                },
                success: function(res){
                    res = JSON.parse(res);
                    if(res['status'] === 'success'){
                        location.reload();
                    }else{
                        alert("Please try again later");
                    }
                }
            });
        });

    });

    function ajax1(){
        return $.ajax({ //GET registered user cart
                url: "servlet/getCart.php",
                method: "post",
                success: function(res){
                    res = JSON.parse(res);
                    console.log(res['data'][0]);
                    var $table = $('<table class="table table-light">'); //Create dynamic table
                    $table.append('<tr><th>Item Name</th><th>Quantity</th><th>Price</th><th>Total</th><th>Action</th></tr>');
                    var total = 0;
                    if(res['status'] === "success"){
                        for(let i = 0; i < res['data'].length; i++){
                            $table.append("<tr>");
                            $table.append("<td>" + res['data'][i]['inventory_name'] + "</td>");
                            $table.append("<td>" + res['data'][i]['quantity'] + "</td>");
                            $table.append("<td>" + res['data'][i]['price'] + "</td>");
                            $table.append("<td>" + res['data'][i]['total'] + "</td>");
                            $table.append("<td>" + "<button " + "class='delete'"+ "id='" + res['data'][i]['inventory_id'] + "'>" + "Delete</button>" + "</td>");
                            $table.append("</tr>");
                            total = total +  res['data'][i]['total'];
                        }
                        $table.append("<tr><td colspan=3>Total Amout</td><td colspan=2>" + total.toFixed(1) + "</td></tr>");
                        $table.appendTo('#table'); //Append it to HTML
                        $('#button-group').show();
        
                    }else if(res['status'] === "fail" && res['data'] === "Haven't register"){
                        alert("Please register or login first :)");
                    }else if(res['status'] === "fail" && res['data'] === "Nothing added to cart"){
                        $('#message').append("<h1>You haven't add anything in the cart</h1>");
                        $('#message').append("<h1><a href='index.php'>Go shopping!</a></h1>");
                    }
                }
            });
    }
    

    $('.clear').click(function(){
        $.ajax({
            url: "./servlet/clearCart.php",
            method: "POST",
            success: function(res){
                res = JSON.parse(res);
                if(res['status'] === 'success'){
                    location.reload();
                }else{
                    alert("Please try again later");
                }
            }
        });
    });

    $('#checkout').click(function(){
        $.ajax({
            url: "./servlet/checkOut.php",
            method: "POST",
            success: function(res){
                res = JSON.parse(res);
                if(res['status'] === 'success'){
                    alert("Check out success");
                }else{
                    alert("Please try again later");
                }
            }
        });
    });

    $('#login-register').click(function(){
        window.location.href = "login.php";
    });
});