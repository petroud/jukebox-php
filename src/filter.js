function showFilters() {
    var x = document.getElementById("filterBox");
    var y = document.getElementById("filterBoxArrow")
    if (x.style.display === "block") {
      x.style.display = "none";
      y.style.display = "none";
    } else {
      x.style.display = "block";
      y.style.display = "block";
    }
}

function logout(){
  location.href = "logout.php";
}


window.onload = function(){

  $('#artistCriteria').on('input',function(){
    
    $('.concert-box').each(function(){
        if($(this).attr("artist").toLowerCase().indexOf($('#artistCriteria').val().toLowerCase()) == -1){
            $(this).hide('slow');
        }else{
            $(this).show('slow');
        }
    })
  })

  $('#genreCriteria').on('input',function(){
    
    $('.concert-box').each(function(){
        if($(this).attr("genre").toLowerCase().indexOf($('#genreCriteria').val().toLowerCase()) == -1){
            $(this).hide('slow');
        }else{
            $(this).show('slow');
        }
    })
  })

  $('#dateCriteria').change(function(){
    var dateCr = $('#dateCriteria').val();
    $('.concert-box').each(function(){
        var thisDate = $(this).attr("date");
        if(!$('#dateCriteria').val()){
            $(this).show('slow');
            return;
        }
        if(new Date(dateCr).toDateString() != new Date(thisDate).toDateString()){
            $(this).hide('slow');
        }else{
            $(this).show('slow');
        }
    })
  })

  $('#unameCriteria').on('input',function(){
    
    $('.concert-box').each(function(){
        if($(this).attr("organizer").toLowerCase().indexOf($('#unameCriteria').val().toLowerCase()) == -1){
            $(this).hide('slow');
        }else{
            $(this).show('slow');
        }
    })
  })
}
   