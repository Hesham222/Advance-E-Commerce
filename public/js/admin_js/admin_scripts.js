$(document).ready(function(){

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
});
