$('document').ready(function(){
    const url  = window.location.search;
    const param = new URLSearchParams(url);
    const id = param.get('comment_id');

    $.ajax({
        url: 'servlet/getOwnComment.php',
        type: 'POST',
        data: {
            'comment_id': id
        },
        success: function(res){
            res = JSON.parse(res);
            if(res['status'] === 'success'){
                $('.image').append('<a href="inventory?inventory_id=' + res['data']['inventory_id'] + '"><img width=300 height=auto src="' + res['data']['inventory_image'] + '"></a>');
                $('.star').append('<input type="number" name="score" value="' + res['data']['score'] + '"></input>');
                $('.comment_time').append(res['data']['comment_time']);
                $('#comment').val(res['data']['comment']);
            }
        }
    });

    $('#comment_form').submit(function(e){
        e.preventDefault();
        let score = 

        $.ajax({
            url: "./servlet/setComment.php",
            method: "post",
            data:{
                'score': score,
                'comment': comment
            },
            success: function(res){
                res = JSON.parse(res);
                if(res['status'] === 'success'){
                    $('#message').empty();
                    $('#message').append("<h1>Comment Success!</h1>");
                }else{
                    $('#message').empty();
                    $('#message').append("<h1>Comment Failed! " + res['data'] + "</h1>");
                }
            }
        });
    });
});