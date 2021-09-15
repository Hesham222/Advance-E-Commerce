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
});
