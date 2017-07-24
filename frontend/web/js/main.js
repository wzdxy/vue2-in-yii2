/**
 * Created by zchi on 2017/7/18.
 */
$(function () {
    initNavBar();
    parallax();

});

function initNavBar() {
    $(".button-collapse").sideNav();
}


function parallax() {
    $('.parallax').parallax();
}