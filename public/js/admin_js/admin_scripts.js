$(document).ready(function(){
//check current password
    $("#current_password").keyup(function(){
        var current_password = $("#current_password").val();
        //alert(current_password);
        $.ajax({
            type: 'post',
            url: '/admin/check-cuurent-pwd',
            data:{current_password:current_password},
            success:function(resp){
                //alert(resp);
                if(resp == "false"){
                    $("#checkCuurentPassword").html("<font color=red>Current Password is Incorrect</font>")
                }else if(resp == "true"){
                    $("#checkCuurentPassword").html("<font color=green>Current Password is correct</font>")
                }
            },error:function(){
                alert("Error");
            }


        });
    });

    //update sections status
    $(".updateSectionStatus").click(function(){
        var status = $(this).text();
        var section_id = $(this).attr("section_id");
        // alert(status);
        // alert(section_id);
        $.ajax({
            type: 'post',
            url: '/admin/update-section-status',
            data:{status:status,section_id:section_id},
            success:function(resp){
                // alert(resp['status']);
                // alert(resp['section_id']);
                if(resp['status']==0){
                    $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>Inactive</a>");
                }else if(resp['status']==1)
                    $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>Active</a>");
            },error:function(){
                alert("Error");
            }
        });
    });

    //update Categories status

    $(".updateCategoryStatus").click(function(){
        var status = $(this).text();
        var category_id = $(this).attr("category_id");
        // alert(status);
        // alert(category_id);
        $.ajax({
            type: 'post',
            url: '/admin/update-category-status',
            data:{status:status,category_id:category_id},
            success:function(resp){
                // alert(resp['status']);
                // alert(resp['category_id']);
                if(resp['status']==0){
                    $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>Inactive</a>");
                }else if(resp['status']==1)
                    $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>Active</a>");
            },error:function(){
                alert("Error");
            }
        });

    });

    //update Products status
    $(".updateProductStatus").click(function(){
        var status = $(this).text();
        var product_id = $(this).attr("product_id");
        // alert(status);
        // alert(category_id);
        $.ajax({
            type: 'post',
            url: '/admin/update-product-status',
            data:{status:status,product_id:product_id},
            success:function(resp){
                // alert(resp['status']);
                // alert(resp['category_id']);
                if(resp['status']==0){
                    $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)'>Inactive</a>");
                }else if(resp['status']==1)
                    $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)'>Active</a>");
            },error:function(){
                alert("Error");
            }
        });

    });
        //update Product Attributes status
        $(".updateAttributeStatus").click(function(){
            var status = $(this).text();
            var attribute_id = $(this).attr("attribute_id");
            // alert(status);
            // alert(category_id);
            $.ajax({
                type: 'post',
                url: '/admin/update-attribute-status',
                data:{status:status,attribute_id:attribute_id},
                success:function(resp){
                    // alert(resp['status']);
                    // alert(resp['category_id']);
                    if(resp['status']==0){
                        $("#attribute-"+attribute_id).html("<a class='updateAttributeStatus' href='javascript:void(0)'>Inactive</a>");
                    }else if(resp['status']==1)
                        $("#attribute-"+attribute_id).html("<a class='updateAttributeStatus' href='javascript:void(0)'>Active</a>");
                },error:function(){
                    alert("Error");
                }
            });

        });

    //append Categories Level
    $('#section_id').change(function(){
        var section_id = $(this).val();
        //alert(section_id);
        $.ajax({
            type:'post',
            url:'/admin/append-categoreies-level',
            data:{section_id:section_id},
            success:function(resp){
                $("#appendCategoriesLevel").html(resp);
            },error:function(){
                alert('Error');
            }
        });
    });


// simple alert to check if you want delete or not
    // $(".confirmDelete").click(function(){
    //     var name = $(this).attr("name");
    //     if(confirm("Are you sure to delete this "+name+"?")){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // });

    //confirm deletion with sweet alert
    $(".confirmDelete").click(function(){
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {

              window.location.href="/admin/delete-"+record+"/"+recordid;
            }
          });
    });

    //Product Attributes Add/Edit Script
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div style="margin-top:10px; margin-left:2px"><input type="text" name="size[]" style="width:120px" value="" placeholder="Size" /><input type="text" name="price[]" style="width:120px" value="" placeholder="Price" /><input type="text" name="stock[]" style="width:120px" value="" placeholder="Stock" /><input type="text" name="sku[]" style="width:120px" value="" placeholder="Sku" /><a href="javascript:void(0);" class="remove_button">Delete</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

});
