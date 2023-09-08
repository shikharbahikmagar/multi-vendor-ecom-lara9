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
    $(document).on("click", ".updateCategoryStatus", function () {
        var status = $(this).children("i").attr("status");
        var category_id = $(this).attr("category_id");
        // alert(status);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-category-status',
            data: { category_id: category_id, status: status },
            success: function (resp) {
                //alert(resp['category_id']);
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#category-" + category_id).html("<i style='font-size: 20px;' class='mdi mdi-checkbox-blank-circle-outline' status='InActive'></i>");
                }
                else if (resp['status'] == 1) {
                    $("#category-" + category_id).html(" <i style='font-size: 20px;' class='mdi mdi-check-circle-outline' status='Active'></i> ");

                }
            }, error: function () {
                alert("error");
            }
        })
    });
    //delete genere 
    $(document).on("click", ".deleteCategory", function(){
        var category_id = $(this).attr("category_id");
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
                window.location.href = "/admin/delete-category/" + category_id;

            }
        });
    });

    //delete category image
    
    $(document).on("click", ".imageConfirmDelete", function () {
        var category_id = $(this).attr("category_id");
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
                window.location.href = "/admin/delete-category-image/" + category_id;

            }
        });
    });

    //update sections status
    $(document).on("click", ".updateSectionStatus", function(){
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section_id");

        //alert(section_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-section-status',
            data: {status:status, section_id:section_id},

            success:function(resp)
            {
                if (resp['status'] == 0) {
                    $("#section-" + section_id).html("<i style='font-size: 20px;' class='mdi mdi-checkbox-blank-circle-outline' status='InActive'></i>");
                }
                else if (resp['status'] == 1) {
                    $("#section-" + section_id).html(" <i style='font-size: 20px;' class='mdi mdi-check-circle-outline' status='Active'></i> ");

                }
            }, error:function()
            {
                alert("error");
            }
        })
    });

    //delete section
    $(document).on("click", ".deleteSection", function () {
        var section_id = $(this).attr("section_id");
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
                window.location.href = "/admin/delete-section/" + section_id;

            }
        });
    });


    //update Brand status
    $(document).on("click", ".updateBrandStatus", function () {
        var status = $(this).children("i").attr("status");
        var brand_id = $(this).attr("brand_id");

        //alert(brand_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-brand-status',
            data: { status: status, brand_id: brand_id },

            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#brand-" + brand_id).html("<i style='font-size: 20px;' class='mdi mdi-checkbox-blank-circle-outline' status='InActive'></i>");
                }
                else if (resp['status'] == 1) {
                    $("#brand-" + brand_id).html(" <i style='font-size: 20px;' class='mdi mdi-check-circle-outline' status='Active'></i> ");

                }
            }, error: function () {
                alert("error");
            }
        })
    });

    //delete Brand
    $(document).on("click", ".deleteBrand", function () {
        var brand_id = $(this).attr("brand_id");
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
                window.location.href = "/admin/delete-brand/" + brand_id;

            }
        });
    });

    //update product status
    $(document).on("click", ".updateProductStatus", function () {
        var status = $(this).children("i").attr("status");
        var product_id = $(this).attr("product_id");

        //alert(product_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-product-status',
            data: { status: status, product_id: product_id },

            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#product-" + product_id).html("<i style='font-size: 20px;' class='mdi mdi-checkbox-blank-circle-outline' status='InActive'></i>");
                }
                else if (resp['status'] == 1) {
                    $("#product-" + product_id).html(" <i style='font-size: 20px;' class='mdi mdi-check-circle-outline' status='Active'></i> ");

                }
            }, error: function () {
                alert("error");
            }
        })
    });

    //delete Product
    $(document).on("click", ".deleteProduct", function () {
        var product_id = $(this).attr("product_id");
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
                window.location.href = "/admin/delete-product/" + product_id;

            }
        });
    });

    //delete Product image
    $(document).on("click", ".imageConfirmDelete", function () {
        var product_id = $(this).attr("product_id");
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
                window.location.href = "/admin/delete-product-image/" + product_id;

            }
        });
    });

    //delete Product video
    $(document).on("click", ".videoConfirmDelete", function () {
        var product_id = $(this).attr("product_id");
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
                window.location.href = "/admin/delete-product-video/" + product_id;

            }
        });
    });

    //add remove product attribute field
    $(document).ready(function () {
        var MaxFieldsAdd = 10; // set number of fields can user add
        var addFieldBtn = $('.add_button'); // add field button selecter 
        var submitBtn = $('.section_wrap'); // Input field submitBtn
        var fieldHTML = '<div><div style="height: 10px;"></div><input type="text" style="width: 120px;" name="size[]" placeholder="Size" Required/>&nbsp;<input style = "width: 120px;" type = "text" name = "price[]" placeholder = "Price" Required/>&nbsp;<input style = "width: 120px;" type = "text" name = "stock[]" placeholder = "Stock" Required/>&nbsp;<input style="width: 120px;" type="text" name="sku[]" placeholder="Sku" Required/>&nbsp;<a style="text-align: inline-block !important;" href="javascript:void(0);" class="deleteBtn">Remove</a></div>';
        var i = 1;
        //add button action
        $(addFieldBtn).click(function () {
            if (i < MaxFieldsAdd) {
                i++;
                $(submitBtn).append(fieldHTML); //append submit button
            } else {
                alert('Only ' + MaxFieldsAdd + ' field are allowed to add');
            }
        });
        //delete button action
        $(submitBtn).on('click', '.deleteBtn', function (e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            i--;
        });
    })

    //update product attribute status
    $(document).on("click", ".updateProductAttributeStatus", function () {
        var status = $(this).children("i").attr("status");
        var attribute_id = $(this).attr("attribute_id");

        //alert(attribute_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-product-attribute-status',
            data: { status: status, attribute_id: attribute_id },

            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#attribute-" + attribute_id).html("<i style='font-size: 20px;' class='mdi mdi-checkbox-blank-circle-outline' status='InActive'></i>");
                }
                else if (resp['status'] == 1) {
                    $("#attribute-" + attribute_id).html(" <i style='font-size: 20px;' class='mdi mdi-check-circle-outline' status='Active'></i> ");

                }
            }, error: function () {
                alert("error");
            }
        })
    });

    //delete Product attribute
    $(document).on("click", ".deleteProductAttribute", function () {
        var attribute_id = $(this).attr("attribute_id");
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
                window.location.href = "/admin/delete-product-attribute/" + attribute_id;

            }
        });
    });

    //update product image status
    $(document).on("click", ".updateProductImageStatus", function () {
        var status = $(this).children("i").attr("status");
        var image_id = $(this).attr("image_id");

        //alert(image_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-product-images-status',
            data: { status: status, image_id: image_id },

            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#image-" + image_id).html("<i style='font-size: 20px;' class='mdi mdi-checkbox-blank-circle-outline' status='InActive'></i>");
                }
                else if (resp['status'] == 1) {
                    $("#image-" + image_id).html(" <i style='font-size: 20px;' class='mdi mdi-check-circle-outline' status='Active'></i> ");

                }
            }, error: function () {
                alert("error");
            }
        })
    });

    //delete Product images
    $(document).on("click", ".deleteProductImage", function () {
        var image_id = $(this).attr("image_id");
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
                window.location.href = "/admin/delete-images/" + image_id;

            }
        });
    });

    //update Banner status
    $(document).on("click", ".updateBannerStatus", function () {
        var status = $(this).children("i").attr("status");
        var banner_id = $(this).attr("banner_id");

        //alert(banner_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-banner-status',
            data: { status: status, banner_id: banner_id },

            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#banner-" + banner_id).html("<i style='font-size: 20px;' class='mdi mdi-checkbox-blank-circle-outline' status='InActive'></i>");
                }
                else if (resp['status'] == 1) {
                    $("#banner-" + banner_id).html(" <i style='font-size: 20px;' class='mdi mdi-check-circle-outline' status='Active'></i> ");

                }
            }, error: function () {
                alert("error");
            }
        })
    });

    //delete Product images
    $(document).on("click", ".deleteBanner", function () {
        var banner_id = $(this).attr("banner_id");
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
                window.location.href = "/admin/delete-banner/" + banner_id;

            }
        });
    });

});