/**
 * Created by zchi on 2017/7/18.
 */
$(function () {
    initNavBar();
    // srf();
});

function initNavBar() {
    $(".button-collapse").sideNav();
}


function srf() {
    if (/Android/gi.test(navigator.userAgent)) {
        window.addEventListener('resize', function () {
            if (document.activeElement.tagName == 'INPUT' || document.activeElement.tagName == 'TEXTAREA') {
                window.setTimeout(function () {
                    document.activeElement.scrollIntoViewIfNeeded();
                }, 0);
            }
        })
    }
}