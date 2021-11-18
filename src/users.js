
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


function editUser(id){
    $('#exitbtn').html('Cancel')
    var x = document.getElementById("editorback");
    if (!x.style.display || x.style.display==="none") {
        x.style.display = "block";
    }  

    var userData = [];

    $('#row_'+id).find('td').each(function () {  
        userData.push($(this).text());
    })

    $('#edit_fname').val(userData[1]);
    $('#edit_lname').val(userData[2]);
    $('#edit_uname').val(userData[3]);
    $('#edit_mail').val(userData[4]);
    $('#edit_role').val(userData[5]).change();
    $('#key_field').val(userData[0]);
}

function submitEdits(){

    var id = $('#key_field').val();

    var fname = $('#edit_fname').val();
    var lname = $('#edit_lname').val();
    var mail = $('#edit_mail').val();
    var role = $('#edit_role').val();

    $.ajax({
        type:'post',
        url:'/tools/edituser.php',
        data:{
            uid:id,
            fname:fname,
            lname:lname,
            email:mail,
            role:role
        },

        success:function(data) {
            if(data === "Successful Update"){
                updateTableRow(id,fname,lname,mail,role);
                dispSuccess(data);
                $('#exitbtn').html('Close')
            }else{
                dispError(data);
            }
                
        }
    })
}

function updateTableRow(id,fname,lname,email,role){
    $('#row_'+id).find("td").eq(1).html(fname);
    $('#row_'+id).find("td").eq(2).html(lname);
    $('#row_'+id).find("td").eq(4).html(email);
    $('#row_'+id).find("td").eq(5).html(role);
}

function dispSuccess(text){
    var x = document.getElementById("resBox");
    var y = document.getElementById("resMsg")
    x.style.display = "block";
    y.innerText = text;
    y.style.color = "#33804C";    
    return;
}

function dispError(text){
    var x = document.getElementById("resBox");
    var y = document.getElementById("resMsg")
    x.style.display = "block";
    y.innerText = text;
    y.style.color = "#870900";    
    return;
}

function dispNothing(){
    var x = document.getElementById("resBox");
    x.style.display = "none";
}

function closeEditor(){
    var x = document.getElementById("editorback");
    dispNothing();
    x.style.display = "none";
}