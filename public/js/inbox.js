
$(function(){

    let googleId = $.cookie("id");
    $.ajax({
        url: `https://www.googleapis.com/gmail/v1/users/${googleId}/messages`,
        type: 'GET'
    }).done(function(res) {
        console.log(res);
    })




});