$(document).ready(function(){
    $('#content_search').submit(function(event){
        event.preventDefault();
        var search = $(this).val();
        console.log(search);
    });

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
});