
var usersTheme = function () {

    var handleToggling = function () {
        $('.dropdown-sidebar-toggler a, .page-sidebar-toggler, .sidebar-toggler').click(function (e) {
            $('body').toggleClass('page-sidebar-open'); 
        });
    };
  
    var handleSidebar = function () {
        var wrapper = $('.page-sidebar-wrapper');
        var wrapperAlerts = wrapper.find('.page-sidebar');

        var initScroll = function () {
            var settingsList = wrapper.find('.page-sidebar-list');
            var settingsListHeight;

            settingsListHeight = wrapper.height() - wrapper.find('.nav-justified > .nav-tabs').outerHeight(); 
			
            Theme.destroySlimScroll(settingsList);
            settingsList.attr("data-height", settingsListHeight);
            Theme.initSlimScroll(settingsList);
        };

        initScroll();
        Theme.addResizeHandler(initScroll); 
    };

    return {

        init: function () { 
            handleToggling(); 
            handleSidebar();
        }
    };

}();
 
jQuery(document).ready(function() {    
   usersTheme.init(); // init metronic core componets
}); 