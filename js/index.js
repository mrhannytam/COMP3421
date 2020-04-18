$(document).ready(function(){
    getInventory();
    function getInventory(){
        $.ajax({
            url: "./servlet/getInventory.php",
            method: "POST",
            success: function(res){
                res = JSON.parse(res);
                if(res['status'] === 'success'){
                    for(let i = 0; i < res['data'].length; i++){
                        var $div = $('<div class="inventory">');
                        $div.append("<div><a href='./inventory.php?inventory_id=" + res['data'][i]['inventory_id'] + "'><img src='" + res['data'][i]['inventory_image'] + "'  width=100 height=100></a></div>")
                        $div.append("<div class='name'>" + res['data'][i]['inventory_name'] + "</div>");
                        $div.append("<div class='price'>" + res['data'][i]['price'] + "</div>");
                        $div.append("</div>");
                        $div.appendTo('#server_inventory');
                    }
                }else{
                    $('#server_inventory').append("<h2>Shop haven't start yet</h2>");
                }
            }
        });
    }
    

    $('#search_form').submit(function(e){
        e.preventDefault();
        var searching = $('#search_bar').val();
        $.ajax({
            url: "./servlet/search.php",
            method: "POST",
            data:{
                'searching': searching
            },
            success: function(res){
                res = JSON.parse(res);
                if(res['status'] === 'success'){
                    $('#server_inventory').empty();
                    for(let i = 0; i < res['data'].length; i++){
                        var $div = $('<div class="inventory">');
                        $div.append("<div><a href='./inventory.php?inventory_id=" + res['data'][i]['inventory_id'] + "'><img src='" + res['data'][i]['inventory_image'] + "'  width=100 height=100></a></div>")
                        $div.append("<div class='name'>" + res['data'][i]['inventory_name'] + "</div>");
                        $div.append("<div class='price'>" + res['data'][i]['price'] + "</div>");
                        $div.append("</div>");
                        $div.appendTo('#server_inventory');
                    }
                }else if(res['status'] === 'fail' && res['data'] === 'Cannot find any results'){
                    $('#server_inventory').empty();
                    $('#message').empty();
                    $('#message').append("<h2>Cannot find any result</h2><hr>");
                    $('#server_inventory').append("<div><h2>You may like:</div>");
                    getInventory();
                }else if(res['status'] === 'fail' && res['data'] === 'Nothing is searching'){
                    $('#server_inventory').empty();
                    $('#message').empty();
                    $('#message').append("<h2>Nothing is searching</h2><hr>");
                    $('#server_inventory').append("<div><h2>You may like:<h2></div>");
                    getInventory();
                }else{
                    $('#message').empty();
                    $('#server_inventory').empty();
                    $('#server_inventory').append("<h2>Shop haven't start yet</h2>");
                }
            }
        });
    });
});