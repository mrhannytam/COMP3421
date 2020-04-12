$(document).ready(function(){
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