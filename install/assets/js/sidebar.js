$(function () {
  // sliding sidebar
  var $sidebar = $('.navbar-collapse');
  var $navbarButton = $('.navbar-toggle');
  var defaultSidebarMargin = $sidebar.css('margin-left');

  var isSidebarShown = function () {
    return $sidebar.css('margin-left') === '0px';
  };

  var hideSidebar = function () {
    $navbarButton.removeClass('in');
    $sidebar.css('margin-left', defaultSidebarMargin);
  };

  var showSidebar = function () {
    $navbarButton.addClass('in');
    $sidebar.css('margin-left', '0%');
  };

  var toggleSidebar = function () {
    if (isSidebarShown()) {
      hideSidebar();
    } else {
      showSidebar();
    }
  };
  
 $('#toc').toc();
  var $page_sidebar = $('.bs-page-sidebar');
  var $body = $(document.body);
  var $navbar = $('.navbar');

  if ($page_sidebar.length) {
    $body.scrollspy({
      target: '.bs-page-sidebar',
      offset: $navbar.height()
    });

    $page_sidebar.affix({
      offset: {
        top: function() {
          var offsetTop = $page_sidebar.offset().top;
          var nPadding = 85;
          return (this.top = offsetTop - nPadding - $navbar.height());
        }, bottom: function() {
          return (this.bottom = $('.bs-page-footer').outerHeight(true));
        }
      } 
    });
  }

  $(document.body).click(function (e) {
    var $target = $(e.target);
    if ($target.closest('.navbar-toggle').length) {
      toggleSidebar();
    } else if (!$target.closest('.collapse').length) {
      hideSidebar();
    }
  });
});