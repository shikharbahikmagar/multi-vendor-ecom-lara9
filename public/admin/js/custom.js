$(document).ready(function(){
    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");

    $("#current_password").keyup(function(){
        var current_password = $("#current_password").val();
        // alert (current_password); return;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/check-admin-password',
            data: {current_password: current_password},
            success: function (resp) {
                // alert(resp);
                // return;
                // console.log(resp);
                if(resp == "false")
                {
                    $("#check_pass").html("<font color='red'>Incorrect Password!</font>");
                }
                else
                {
                    $("#check_pass").html("<font color='green'>Correct Password</font>");
                }
            },error:function()
            {
                alert("error");
            }
        });

    })
    //update admin status
    $(document).on("click", ".updateAdminStatus", function(){
        var status = $(this).children("i").attr("status");
        var admin_id = $(this).attr("admin_id");
        // alert(status);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-admin-status',
            data: {admin_id:admin_id, status:status},
            success:function(resp)
            {
            //alert(resp['admin_id']);
                if(resp['status'] == 0)
                {
                    $("#admin-"+admin_id).html("<i style='font-size: 20px;' class='mdi mdi-checkbox-blank-circle-outline' status='InActive'></i>");
                }
                else if (resp['status'] == 1)
                {
                    $("#admin-"+admin_id).html(" <i style='font-size: 20px;' class='mdi mdi-check-circle-outline' status='Active'></i> ");

                }
            }, error:function()
            {
                alert("error");
            }
        })
    });

    //update genres status
    $(document).on("click", ".updateGenreStatus", function () {
        var status = $(this).children("i").attr("status");
        var genre_id = $(this).attr("genre_id");
        // alert(status);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-genre-status',
            data: { genre_id: genre_id, status: status },
            success: function (resp) {
                //alert(resp['genre_id']);
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#genre-" + genre_id).html("<i style='font-size: 20px;' class='mdi mdi-checkbox-blank-circle-outline' status='InActive'></i>");
                }
                else if (resp['status'] == 1) {
                    $("#genre-" + genre_id).html(" <i style='font-size: 20px;' class='mdi mdi-check-circle-outline' status='Active'></i> ");

                }
            }, error: function () {
                alert("error");
            }
        })
    });
    //delete genere 
    $(document).on("click", ".deleteCategory", function(){
        var cat_id = $(this).attr("cat_id");
        //alert(cat_id);
    
        // $.ajax({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     type: 'post',
        //     url: '/admin/delete-genre',
        //     data: {cat_id: cat_id},
        //     success:function(resp)
        //     {
        //         alert(resp);
        //     }, errro:function()
        //     {
        //         alert("error");
        //     }

        // })
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "/admin/delete-genre/" + cat_id;

            }
        });
    });
});