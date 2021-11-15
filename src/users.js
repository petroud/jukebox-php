
function delUser(id){
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


function statusUser(id){
    $.ajax({
        type:'post',
        url:'/tools/confedit.php',
        data:{
            uid:id 
        },
        success:function(data){
            if(data === "Not Allowed"){
                $('#status_'+id).text('Not Allowed').show().delay(1000).fadeOut(500,function(){$('#status_'+id).text('Confirmed').show()});
                return;
            }
            if($('#status_'+id).html() === "Confirmed"){
                $('#status_'+id).html('Deactivated');
            }else{
                $('#status_'+id).html('Confirmed');
            }
        }
    });
}


