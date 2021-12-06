function delConcert(id){

    if(confirm('Permanently delete concert "'+$('#title_'+id).html()+'" from Jukebox')){
        $.ajax({
            type:'post',
            url:'/tools/concertdel.php',
            data:{
                cid:id 
            },
            success:function(data){
                $('#row_'+id).hide('slow');
            }
        });
    }
}



function editConcert(id){
    $('#exitbtn').html('Cancel')
    var x = document.getElementById("editorback");

    if (!x.style.display || x.style.display==="none") {
        x.style.display = "block";        
    }  

    $(document).mouseup(function(e) {
        var container = $("#editor-box");
        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0){
            closeEditor();
        }
    });
  

    var concertData = [];

    $('#row_'+id).find('td').each(function () {  
        concertData.push($(this).text());
    })


    $('#edit_title').val(concertData[1]);
    $('#edit_artist').val(concertData[3]);
    document.getElementById("edit_date").valueAsDate = new Date(concertData[2]);
    $('#edit_genre').val(concertData[4]);
    $('#key_field').val(concertData[0]);
}



function newConcert(){
    $('#addExitbtn').html('Cancel')
    var x = document.getElementById("adderback");

    if (!x.style.display || x.style.display==="none") {
        x.style.display = "block";        
    }  

    $(document).mouseup(function(e) {
        var container = $("#adder-box");
        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0){
            cleanAdder();
        }
    });    
}

function addConcert(){

    var title = $('#new_title').val();
    var artist = $('#new_artist').val();
    var genre = $('#new_genre').val();
    var date = $('#new_date').val();

    $.ajax({
        type:'post',
        url:'/tools/addconcert.php',
        data:
        JSON.stringify({
            title:title,
            artistname:artist,
            date: date,
            genre: genre
        }),
        dataType:"JSON",
        success:function(res) {
            if(res.response === "New concert added!"){
                newSuccess("Added successfully!");
                $('#addExitbtn').html('Close');
                $('#concert-table tr:last').after('<tr id="row_'+res.newID+'"><td>'+res.newID+'</td> <td id="title_'+res.newID+'">'+title+'</td> <td>'+date+'</td> <td>'+artist+'</td> <td>'+genre+'</td> <td> <a href="javascript:editConcert('+res.newID+')"><img class = "conf-ico" src="/assets/editing.png" alt="edit concert"></a><a href="javascript:delConcert('+res.newID+')"><img class = "conf-ico" src="/assets/bin.png" alt="delete concert"></a></td> </tr>');
                $(this).delay(2000).queue(function() {
                    $(this).hide();
                    resetAdder();
                    $(this).dequeue();
                });        
            }else{
                newError("Please fill in all fields");
            }
                
        }
    })
}

function submitEdits(){

    var id = $('#key_field').val();

    var title = $('#edit_title').val();
    var artist = $('#edit_artist').val();
    var genre = $('#edit_genre').val();
    var date = $('#edit_date').val();


    $.ajax({
        type:'post',
        url:'/tools/editconcert.php',
        data:
            JSON.stringify(
            {
                cid:id,
                title:title,
                artist:artist,
                date: date,
                genre: genre
            }),
        dataType: 'JSON',
        success:function(res) {
            if(res.response === "Successful Update"){
                updateTableRow(id,title,date,artist,genre);
                dispSuccess(res.response);
                $('#exitbtn').html('Close')
            }else{
                dispError(res.response);
            }
                
        }
    })
}

function updateTableRow(id,title,date,artist,genre){
    $('#row_'+id).find("td").eq(1).html(title);
    $('#row_'+id).find("td").eq(3).html(artist);
    $('#row_'+id).find("td").eq(4).html(genre);
    $('#row_'+id).find("td").eq(2).html(date);
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


function newSuccess(text){
    var x = document.getElementById("addResBox");
    var y = document.getElementById("addResMsg")
    x.style.display = "block";
    y.innerText = text;
    y.style.color = "#33804C";    
    return;
}

function newError(text){
    var y = document.getElementById("addResMsg");
    x.style.display = "block";
    y.innerText = text;
    y.style.color = "#870900";    
    return;
}

function newNothing(){
    var x = document.getElementById("addResBox");
    x.style.display = "none";
}

function resetAdder(){
    newNothing();
    $('#new_title').val('');
    $('#new_artist').val('');
    $('#new_genre').val('');
    $('#new_date').val('');
}


function closeEditor(){
    var x = document.getElementById("editorback");
    dispNothing();
    x.style.display = "none";
}

function closeAdder(){
    var x = document.getElementById("adderback");
    dispNothing();
    x.style.display = "none";
}