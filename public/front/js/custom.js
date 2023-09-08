$(document).ready(function(){
    $("#sort").on('change', function () {
        var url = $("#url").val();
        var sort = $("#sort").val();
        // alert(url); return false;
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:url,
            method: 'post',
            data: {sort:sort, url:url},
            success:function(data)
            {
                $('.filter_products').html(data);
            },
            error:function()
            {
                alert("error");
            }


        })
    });

});