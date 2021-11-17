
function delUser(id){

    if(confirm('Permanently delete user '+$('#uname_'+id).html()+' from Jukebox')){
        $.ajax({
            type:'post',
            url:'/tools/userdel.php',
            data:{
                uid:id 
            },
            success:function(data){
                $('#row_'+id).hide('slow');
            }
        });
    }
}



function statusUser(id){
    $.ajax({
        type:'post',
        url:'/tools/confedit.php',
        data:{
            uid:id 
        },
        success:function(data){
            if(data === "Not Allowed"){
                $('#status_'+id).text('Not Allowed').attr("style","color:orange").show().delay(1000).fadeOut(500,function(){$('#status_'+id).text('Confirmed').attr("style","color:green").show()});
                return;
            }
            if($('#status_'+id).html() === "Confirmed"){
                $('#status_'+id).html('Deactivated').attr("style","color:red");
            }else{
                $('#status_'+id).html('Confirmed').attr("style","color:green");
            }
        }
    });
}
