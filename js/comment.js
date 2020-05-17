$('document').ready(function(){
    const url  = window.location.search;
    const param = new URLSearchParams(url);
    const id = param.get('comment_id');

    function ajax1(){
        return $.ajax({
            url: 'servlet/getOwnComment.php',
            type: 'POST',
            data: {
                'comment_id': id
            },
            success: function(res){
                res = JSON.parse(res);
                if(res['status'] === 'success'){
                    $('.image').append('<a href="inventory.php?inventory_id=' + res['data']['inventory_id'] + '"><img width=250 height=auto src="' + res['data']['inventory_image'] + '"></a>');
                    $('.star').append('Rating : <input type="number" id="score" name="score" value="' + res['data']['score'] + '"></input>');
                    $('.comment_time').append('Comment Time : ' + res['data']['comment_time']);
                    $('#comment').val(res['data']['comment']);
                }else{
                    $('#message').empty();
                    $('#message').append("<h1>You should not be here</h1>");
                }
            }
        });
    }
    

    $.when(ajax1()).done(function(){
        $('#comment_form').submit(function(e){
            e.preventDefault();
            let score = $('#score').val();
            let comment = $('#comment').val();
            $.ajax({
                url: "./servlet/setComment.php",
                method: "post",
                data:{
                    'comment_id': id,
                    'score': score,
                    'comment': comment
                },
                success: function(res){
                    res = JSON.parse(res);
                    if(res['status'] === 'success'){
                        $('#message').empty();
                        $('#message').append("<h1 class='text-success'>Comment Success!</h1>");
                    }else{
                        $('#message').empty();
                        $('#message').append("<h1 class='text-danger'>Comment Failed!   " + res['data'] + "</h1>");
                    }
                }
            });
        });
    });
    
});