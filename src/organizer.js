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
            x.style.display = "none"
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

function submitEdits(){

    var id = $('#key_field').val();

    var title = $('#edit_title').val();
    var artist = $('#edit_artist').val();
    var genre = $('#edit_genre').val();
    var date = $('#edit_date').val();


    $.ajax({
        type:'post',
        url:'/tools/editconcert.php',
        data:{
            cid:id,
            title:title,
            artist:artist,
            date: date,
            genre: genre
        },

        success:function(data) {
            if(data === "Successful Update"){
                updateTableRow(id,title,date,artist,genre);
                dispSuccess(data);
                $('#exitbtn').html('Close')
            }else{
                dispError(data);
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

function closeEditor(){
    var x = document.getElementById("editorback");
    dispNothing();
    x.style.display = "none";
}