function addFave(cid){
    $.ajax({
      type: 'post',
      url: "tools/addfave.php",
      data: {
          fid: cid
       },
      success: function(){
           $('#btnconcert'+cid)
                 .addClass('faved')
                 .attr("onclick","removeFave("+cid+")")
        }
    });
}

function removeFave(cid){
    $.ajax({
      type: 'post',
      url: "/tools/delfave.php",
      data: {
        fid: cid
      },
      success: function(){
            $('#btnconcert'+cid)
                 .removeClass('faved')
                 .attr("onclick","addFave("+cid+")")
      }
    });
}