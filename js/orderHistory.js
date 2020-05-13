$(document).ready(function(){
    $.ajax({
        url: "./servlet/getOrderHistory.php",
        method: "POST",
        success: function(res){
            res = JSON.parse(res);
            if(res['status'] === 'success'){

                var $table = $('<table class="table">'); //Create dynamic table
                $table.append("<tr><th>Purchase ID</th><th>Inventory ID</th><th>Quantity</th><th>Delivered?</th><th>Purchase Time</th><th>Comment!</th></tr>");
                for(let i = 0; i < res['data'].length; i++){
                    $table.append("<tr>");
                    $table.append("<td>" + res['data'][i]['purchase_id'] + "</td>");
                    $table.append("<td><a href='inventory.php?inventory_id=" + res['data'][i]['inventory_id'] + "'>" +  res['data'][i]['inventory_id']  + "</a></td>");
                    $table.append("<td>" + res['data'][i]['quantity'] + "</td>");
                    $table.append("<td>" + res['data'][i]['deliver'] + "</td>");
                    $table.append("<td>" + res['data'][i]['purchase_time'] + "</td>");
                    $table.append("<td><a href='comment.php?comment_id=" + res['data'][i]['purchase_id'] + "'>" + 'click here' + "</a></td>");
                    $table.append("</tr>");
                }
                $table.append("</table>");
                $table.appendTo('#order-history');



            }else if(res['status'] === 'fail' && res['data'] === "Haven't login"){
                $(".message").append("<h1>Please login first</h1>");
            }else{
                $(".message").append("<h1>You haven't brought anything</h1>");
                $(".message").append("<a href='index.php'>Got to shopping!</a>");
            }
        }
    });
});