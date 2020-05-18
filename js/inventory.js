$(document).ready(function(){
    const url  = window.location.search;
    const param = new URLSearchParams(url);
    const id = param.get('inventory_id');
    
    function getOneInventory(){
        return $.ajax({
                    url:'servlet/getOneInventory.php',
                    method:'POST',
                    data:{
                        'inventory_id': id
                    },
                    success: function(res){
                        res = JSON.parse(res);
                        if(res['status'] === 'success'){
                            $('#inventory').append("<h1>" + res['data']['inventory_name'] + "</h1>");
                            $('#inventory').append("<img src='" + res['data']['inventory_image'] + "' class='img-thumbnail inventory'>");
                            $('#inventory').append("<h2>$" + res['data']['price'] + "</h2>");
                            $('#inventory').append("<input type='number' name='quantity' id='quantity' placeholder='Quantity' value='1'>");
                            $('#inventory').append("<button class='add-to-cart' id='" + id + "'>Add to Cart</button>");
                        }else{
                            $('.message').append('<h2 class="text-danger">Your action has been reported</h2>')
                        }
                    }
                });
    }
    
    function getComment(){
        return $.ajax({
            url: 'servlet/getComment.php',
            method: 'POST',
            data:{
                'inventory_id': id
            },
            success: function(res){
                res = JSON.parse(res);
                if(res['status'] === 'success'){
                    for(var i = 0; i < res['data'].length; i++){
                        $('.col-4').append('<h3>' + res['data'][i]['user_id'] + '</h3><h6>' + res['data'][i]['comment_time'] + '</h6>'+'<br>');
                        for(let j = 0; j < res['data'][i]['score']; j ++){
                            $('.star').append('<span class="fa fa-star checked"></span>');
                        }
                        if(res['data'][i]['score'] < 5){
                            for(let j = 0; j < 5 - res['data'][i]['score']; j++){
                                $('.star').append('<span class="fa fa-star"></span>');
                            }
                        }
                        $('.star').append('<hr>'+'<h4>' + res['data'][i]['comment'] + '</h4>');

                    }
                }else if(res['status'] === 'fail' && res['data'] === 'no comment yet'){
                    $('#comment').append('<h2>No Comment Yet</h2>');
                }else{
                    $('.message').append('<h2 class="text-danger">Your action has been reported</h2>');
                }
            }
        });
    }

    $.when(getOneInventory(), getComment()).done(function(){
        $(".add-to-cart").click(function(){
            var inventory_id = $(this).attr('id');
            var quantity = $('#quantity').val();
            if(quantity > 0){
                $.ajax({
                    url: "servlet/addToCart.php",
                    method: "POST",
                    data: {
                        "inventory_id": inventory_id,
                        "quantity": quantity
                    },
                    success: function(res){
                        res = JSON.parse(res);
                        if(res['status'] === 'success'){
                            alert("Added to cart");
                        }else{
                            alert("Try not to inject something");
                        }
                    }
                });
            }else{
                alert("You can't add nothing to the cart :)");
            }
        });
    });
});