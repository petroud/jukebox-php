function fetchNotifications(){
    $.ajax({
        type: "get",
        url: "notification/getUserNotifications.php",
    
        success: function (res) {
            var notifDiv = document.getElementById("notBox");
            notifDiv.innerHTML = "";

            response = JSON.parse(res);
    
            for(var i=0 ; i<response.length; i++){
                var item = response[i];            
                var tmpDiv = document.createElement('div');
                tmpDiv.innerHTML = '<p>'+item.msg+'</p><p>- '+item.time+'</p>'
                tmpDiv.className = "notification";
                notifDiv.appendChild(tmpDiv);
            }
        }
    });

    setTimeout(fetchNotifications, 5000);
}