/*
 * Settings of the sticky menu
 */

jQuery(document).ready(function($){
    $(window).load(function(){
        var headerHeight = $('#tm-headermenu-section').outerHeight();
        $('.primary-menu-container').onePageNav({
            currentClass: 'current',
            changeHash: false,
            scrollSpeed: 800,
            scrollOffset: headerHeight,
            scrollThreshold: 0.5
        });
    });
});