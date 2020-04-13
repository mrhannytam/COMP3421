$(document).ready(function(){
    alert('hi');
    $('#content_search').submit(function(event){
        event.preventDefault();
        var search = $(this).val();
        console.log(search);
    });
});