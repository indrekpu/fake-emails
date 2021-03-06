function addmsg(msg){

   $("#total").html(msg);
}

function waitForMsg(){
    /* This requests the url "msgsrv.php"
     When it complete (or errors)*/
    $.ajax({
        type: "GET",
        url: "https://www.medesteetika.ee/fake-emails/statistics",

        async: true, /* If set to non-async, browser shows page as "Loading.."*/
        cache: false,
        timeout:50000, /* Timeout in ms */

        success: function(data){ /* called when request to barge.php completes */
            addmsg(data); /* Add response to a .msg div (with the "new" class)*/
            setTimeout(
                waitForMsg, /* Request next message */
                5000 /* ..after 1 seconds */
            );
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
            addmsg(textStatus + " (" + errorThrown + ")");
            setTimeout(
                waitForMsg, /* Try again after.. */
                15000); /* milliseconds (15seconds) */
        }
    });
};

$(document).ready(function(){
    waitForMsg(); /* Start the inital request */
});