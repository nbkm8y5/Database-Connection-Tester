var myVar=setInterval(function(){clock()},1000);

function clock() {
    var d = new Date();
    $("#clock").html(d.toLocaleTimeString());
}
$(document).ready(clock);