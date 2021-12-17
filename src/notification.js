$( document ).ready(function() {
    fetchNotifications();
});

function fetchNotifications(){
    $.ajax({
        type: "get",
        url: "notification/getUserNotifications.php",
    
        success: function (res) {
            var notifDiv = document.getElementById("notBox");
            notifDiv.innerHTML = "";

            response = JSON.parse(res);
            var unseenExists = false;
    
            for(var i=0 ; i<response.length; i++){
                var item = response[i];            
                var tmpDiv = document.createElement('div');
                tmpDiv.setAttribute("id","notification_"+item.notifID);
                var inner = '<div class="notifText"><p class="notifMsg">'+item.msg+'</p><p class="notifTime">- '+item.time+'</p>';

                if(item.seen == 0){
                    unseenExists = true;
                    var seenLink = "<a href=\"javascript:notificationSeen("+item.notifID+");\" id=\"seenLink_"+item.notifID+"\" class=\"marker\">Mark as seen</a>";
                    var inner = inner+seenLink;
                }
                tmpDiv.innerHTML = inner+"</div>";
                tmpDiv.className = "notification";
                notifDiv.insertBefore(tmpDiv,notifDiv.firstChild);
            }

            if(unseenExists){
                var notifIco = document.getElementById("notifImg");
                notifIco.src = "assets/bellfull.png";
            }else{
                var notifIco = document.getElementById("notifImg");
                notifIco.src = "assets/bell.png";
            }
        }
    });

    setTimeout(fetchNotifications, 5000);
}


function notificationSeen(nid){
    $.ajax({
        type: "post",
        url: "notification/notificationSeen.php",
        data: {
            nid:nid
        },
        success: function (response) {
            var notification = document.getElementById("notification_"+nid);
            var seenPrompt = document.getElementById("seenLink_"+nid);
            notification.removeChild(seenPrompt);

        }
    });
}
function notifyme() { 
    var x = document.getElementById('notifs');
    if (x.style.display === 'none') {
      x.style.display = 'block';
    } else {
      x.style.display = 'none';
    }
}