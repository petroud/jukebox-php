	 
function delFave(id){
    $.ajax({
        type:'post',
        url:'/tools/delfave.php',
        data:{
            fid:id
            
        },
        success:function(data){
            $('#fave'+id).hide('slow');
        }
    });
}


