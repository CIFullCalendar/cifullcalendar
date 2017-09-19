var ProductInfo = function () {
 
	var handleProduct = function () { 
      $('.product').backstretch('assets/bootlaces/img/frontend/bg.jpg');
    };   
    return { 
        init: function () { 
            handleProduct(); // handles  
        }
    };
}();
 
jQuery(document).ready(function() {    
   ProductInfo.init(); // init core componets
}); 