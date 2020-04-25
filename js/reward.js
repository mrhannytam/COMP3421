$(document).ready(function(){
    $.ajax({
        url:'servlet/getPoint.php',
        method:'POST',
        success: function(res){
            res = JSON.parse(res);
            if(res['status'] === 'success'){
                $('#points').text(res['data'] + ' Points');
            }else{
                $('#points').text('NaN Points');
                $('.message').append('<h2>Please try again later </h2>');
            }
        }
    });

    $.ajax({
        url:'servlet/getOwnGift.php',
        method:'POST',
        success: function(res){
            res = JSON.parse(res);
            if(res['status'] === 'success'){
                for(let i = 0; i < res['data'].length; i++){
                    var div = $('<button class="btn btn-light"><div class="own">');
                    div.append('<div><img src="' + res['data'][i]['gift_image'] + '" width=100 height=100></div>');
                    div.append('<div class="name">  Name: ' + res['data'][i]['gift_name'] + '</div>');
                    div.append('<div class="quantity"> Quantity: ' + res['data'][i]['quantity'] + '</div>');
                    div.append('</div></button>');
                    div.appendTo('.own_gift');
                }
            }else{
                $('own_gift').append("<h3>You don't have any reward</h3>");
            }
        }
    });
   

    $.when(ajax()).done(function(){
   

        $('button').click(function(){
            var id = $(this).attr('id');
            $.ajax({
                url:'servlet/exchange.php',
                method:'POST',
                data:{
                    'exchange_id': id
                },
                success: function(res){
                    res = JSON.parse(res);
                    if(res['status'] === 'success'){
                        $('.message').empty();
                        $('.message').append("<h2 class='text-success'>Exchange Success</h2>");
                    }else{
                        $('.message').empty();
                        $('.message').append("<h2 class='text-danger'>Not Enough Points</h2>");
                    }
                }
            });
        });
    });
    function ajax(){
        return $.ajax({
                url:'servlet/getGift.php',
                method:'POST',
                success: function(res){
                    res = JSON.parse(res);
                    if(res['status'] === 'success'){
                        for(let i = 0; i < res['data'].length; i++){
                            var div = $('<button class="btn btn-light card" id="' + res['data'][i]['gift_id'] + '"><div class="gift">');
                            div.append("<div><img src='" + res['data'][i]['gift_image'] + "'width=100 height=100></div>");
                            div.append("<div class='name'>" + res['data'][i]['gift_name'] + "</div>");
                            div.append("<div class='price'>" + res['data'][i]['gift_point'] + "</div>");
                            div.append('</div></button>');
                            div.appendTo('#gifts');
                        }
                    }else{
                        $('.message').append('<h2 class="text-danger">' + res['data'] + '</h2>');
                    }   
                }
            });
    }
    

    

    
    
});