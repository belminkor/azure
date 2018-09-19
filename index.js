$(document).ready(function() {
    $('.kvadrat').height($('.kvadrat').width() - $('.kvadrat').width()*0.2);
});


$("#login-dugme").click(function(){
    console.log("pozvao");
    $("#slajder").slideDown();
});