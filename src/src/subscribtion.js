function subscribe(cid){
    $.ajax({
        type: "post",
        url: "/orion/add_subscription.php",
        data: {
            cid:cid
        },
        success: function (response) {
            $('#subConcert'+cid)
            .addClass('subscribed')
            .attr("onclick","unsubscribe("+cid+")")
        }
    });
}



function unsubscribe(cid){
    $.ajax({
        type: "post",
        url: "/orion/delete_subscription.php",
        data: {
            cid:cid
        },
        success: function (response) {
            $('#subConcert'+cid)
                 .removeClass('subscribed')
                 .attr("onclick","subscribe("+cid+")")
        }
    });
}