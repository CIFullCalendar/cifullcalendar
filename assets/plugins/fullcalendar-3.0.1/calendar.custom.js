/*!
 * CIFullCalendar v3
 * Docs & License: http://www.cifullcalendar.com
 * (c) 2016 Sir.Dre
 */
(function(factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        // AMD is used - Register as an anonymous module.
        define(['jquery', 'moment'], factory);
    } else if (typeof exports === 'object') {
        factory(require('jquery'), require('moment'), require('google.maps.Geocoder'));
    } else {
        // Neither AMD nor CommonJS used. Use global variables.
        if (typeof google.maps.Geocoder === 'undefined') {
            throw 'CIFullCalendar requires Gmaps to be loaded first';
        }        
		if (typeof jQuery === 'undefined') {
            throw 'CIFullCalendar requires jQuery to be loaded first';
        }
        if (typeof moment === 'undefined') {
            throw 'CIFullCalendar requires Moment.js to be loaded first';
        }
        factory(jQuery, moment);
    }
})(function($, moment) {

;;


	$.cifullCalendar = { version: "3.3.9.9", internalApiVersion: 6 };  
	var FC = $.fullCalendar;
  
	if (FC.internalApiVersion !== 6) {
		FC.warn('Incompatible with v' + FC.version + ' of the core.\n' + 'Please see http://sirdre.com for more information.');
		return;
	}
	
 	var cifc = $.cifullCalendar = function (options) {
        $.options = options;  
		$.getRequest();
        $.init();
	};	 

	cifc.DEFAULTS = { 
		locale: undefined
	}; 
	
    cifc.LOCALES = []; 
	 
    cifc.prototype.init = function () {  
		$.businessDOW();
		$.timedUpdate();
	};
 
   $.fn.cifullCalendar = function (option) {
        var value,
            args = Array.prototype.slice.call(arguments, 1);

        this.each(function () {
            var $this = $(this),
                data = $this.data('calendar'),
                options = $.extend({}, cifc.DEFAULTS, $this.data(),
                    typeof option === 'object' && option);

            if (typeof option === 'string') {
                if ($.inArray(option) < 0) {
                    throw new Error("Unknown method: " + option);
                }

                if (!data) {
                    return;
                }

                value = data[option].apply(data, args);

                if (option === 'destroy') {
                    $this.removeData('calendar');
                }
            }
 
        });

        return typeof value === 'undefined' ? this : value;
    };
 	 
	$.fn.cifullCalendar.defaults = cifc.DEFAULTS;
	$.fn.cifullCalendar.locales = cifc.LOCALES;
	 
	var map;
	var geocoder = new google.maps.Geocoder();
	var infowindow = new google.maps.InfoWindow();
	var bounds = new google.maps.LatLngBounds();
	var markers = []; 	
	
	var lang = $.extend(cifc.DEFAULTS, cifc.LOCALES['en']); 
	
	//formats
    var snippets = [];	
	var datetimeformat = 'YYYY-MM-DD HH:mm:ss';
	var datetimetzformat = 'YYYYMMDD[T]HHmmss';
	var datetimeaformat = 'dddd, MMMM Do, h:mm:ss a'; 
	var datetimeaformat2 = 'MMMM DD YYYY, h:mm:ss a'; 
	var dateformat = 'YYYY-MM-DD';
	var monthdayformat = 'MMM DD';
	var day = 'DD';
	var time24format = 'HH:mm:ss';	
	var timeformat = 'hh:mm:ss';
	var timeaformat = 'h:mm:ss a';
	var slotformat = 'hh:mm a';
	var clockformat = 'h:mm:ss'; 
	var hourformat = 'h';
	var minformat = 'mm';
	var secformat = 'ss';
	var second = '';
	var minute = '';
	var hour = '';
	var ampmformat = 'a';
	
	var viewmode = 'months';
			
	var eventSources = new Array();
	var filterSources = new Array();  
	
	var regex = new RegExp("(.+)");
	var get_url = window.location.pathname.replace(regex, './profile/home/');
	
	var siteurl = window.location.pathname.replace('index.php/profile', '');	
				
	var attached_url = window.location.pathname.replace('index.php/profile', '') 
				+ "assets/attachments/";	
			 
	var currentDefaultview = '';
	var currentLangCode = 'en'; 
	var currentTimezoneCode = '';
	var currentTimezoneCode2 = '';
	var currentCoordinate = '';
	var startdate = 'start';
	var enddate = 'end';
	var eventorder = 'title';	
	var timescroll = '';
	var headerLeft = '';
	var headerCenter = '';
	var headerRight = '';
	var aspectratio = 1.45; 
	var hiddendays = '';
	var hiddenday0 = '';
	var hiddenday1 = '';
	var hiddenday2 = '';
	var hiddenday3 = '';
	var hiddenday4 = '';
	var hiddenday5 = '';
	var hiddenday6 = ''; 
	var slotduration = '00:30:00';
	var slotlabeling = false;
	var firstday = 0; 	 
	var businessStart = '';
	var businessEnd = '';
	var businessdays = '';
	var businessdays0 = '';
	var businessdays1 = '';
	var businessdays2 = '';
	var businessdays3 = '';
	var businessdays4 = '';
	var businessdays5 = '';
	var businessdays6 = '';
	var resourceAreaWidth = '';
	var resourceLabelText = '';
	var	mintime = '00:00:00';
	var	maxtime = '24:00:00';	
	var longpressdelay = 300; 
	var editable1 = true;
	var weeknumbers1 = false;
	var eventlimit1 = true;
	var alldayslot = true;
	var nowindicator = true;
	var isrtl = false;
	var navlinks = true;
	var googlecalendarapikey = '';
		 
	initialise_color_pickers();	
			
	// re-render the calendar when the selected option changes  
	getRequest(get_url +"get_timezone", function(err, data) { 
		if(!empty(data)){
			currentTimezoneCode = $.trim(data); 
		}			
	});	
	
	getRequest(get_url +"get_timezone2", function(err, data) {	 
		if(!empty(data)){
			currentTimezoneCode2 = data;
			timescroll = moment.tz(currentTimezoneCode2).format(time24format); 
		}
	});
	
	getRequest(get_url +"get_defaultview", function(err, data) { 
		if(!empty(data) && is_string(data)){
			currentDefaultview = $.trim(data);
		}
	});	
	
	getRequest(get_url +"get_header_left", function(err, data) { 
		if(!empty(data)){
			headerLeft = $.trim(data);
		}
	});	
	
	getRequest(get_url +"get_header_center", function(err, data) {			 
		if(!empty(data)){
			headerCenter = $.trim(data); 
		}
	});	
	
	getRequest(get_url +"get_header_right", function(err, data) {	 
		if(!empty(data)){
			headerRight = $.trim(data); 
		}
	});	
	
	getRequest(get_url +"get_apikey", function(err, data) {			 
		if(!empty(data)){
			googlecalendarapikey = $.trim(data); 
		}
	});		
	
	getRequest(get_url +"get_editable", function(err, data) {			 
		if(!empty(data)){
			(data == "true") ? editable1 = true : editable1 = false;  
		}
	});		
		
	getRequest(get_url +"get_firstday", function(err, data) { 
		if(!empty(data)){
			firstday = $.trim(data);
		}
	});	
	
	getRequest(get_url +"get_mintime", function(err, data) { 
		if(!empty(data)){
			mintime = $.trim(data);
		}
	});	
	
	getRequest(get_url +"get_maxtime", function(err, data) { 
		if(!empty(data)){
			maxtime = $.trim(data); 
		}
	});	 
	
	getRequest(get_url +"get_businessstart", function(err, data){ 
		if(!empty(data)){
			businessStart = $.trim(data);	 
		}
	});	
	
	getRequest(get_url +"get_businessend", function(err, data){	 
		if(!empty(data)){
			businessEnd = $.trim(data);  
		}
	});	
	
	getRequest(get_url +"get_businessdays", function(err, data){ 
		if(!empty(data)){
			businessdays = data.split(",");
			businessdays0 = Number(businessdays[0]);
			businessdays1 = Number(businessdays[1]);
			businessdays2 = Number(businessdays[2]);
			businessdays3 = Number(businessdays[3]);
			businessdays4 = Number(businessdays[4]);
			businessdays5 = Number(businessdays[5]);
			businessdays6 = Number(businessdays[6]); 
			 
		}
	});	
	
	getRequest(get_url +"get_aspectratio", function(err, data) {		 
		if(!empty(data)){
			(data != aspectratio ) ? aspectratio = $.trim(data) : aspectratio = aspectratio; 
		}
	});	
		
	getRequest(get_url +"get_hiddendays", function(err, data) {			 
		if(!empty(data)){
			hiddendays = data.split(",");
			hiddenday0 = Number(hiddendays[0]);
			hiddenday1 = Number(hiddendays[1]);
			hiddenday2 = Number(hiddendays[2]);
			hiddenday3 = Number(hiddendays[3]);
			hiddenday4 = Number(hiddendays[4]);
			hiddenday5 = Number(hiddendays[5]);
			hiddenday6 = Number(hiddendays[6]); 
		}
	});	
	
	getRequest(get_url +"get_weeknumbers", function(err, data) {			 
		if(!empty(data)){
			(data == "true") ? weeknumbers1 = true : weeknumbers1 = false; 
		}
	});	
	
	getRequest(get_url +"get_eventlimit", function(err, data) {			 
		if(!empty(data)){
			(data == "true") ? eventlimit1 = true : eventlimit1 = false; 
		}
	});	
		
	getRequest(get_url +"get_alldayslot", function(err, data) {			 
		if(!empty(data)){
			(data == "true") ? alldayslot = true : alldayslot = false; 
		}
	});	

	getRequest(get_url +"get_slotduration", function(err, data) {			 
		if(!empty(data)){
			slotduration = $.trim(data);
		}
	});		
	
	getRequest(get_url +"get_slotlabeling", function(err, data) {	 
		if(!empty(data)){
			(data == "true") ? slotlabeling = true : slotlabeling = false; 
		} 
	});	
	
	getRequest(get_url +"get_slotlabelformat", function(err, data) {	 
		if(!empty(data)){
			slotformat = $.trim(data);
			datetimeaformat2 = "MMMM DD YYYY, "+ $.trim(data);
		} 
	});	
	
	getRequest(get_url +"get_isrtl", function(err, data) {	 
		if(!empty(data)){
			(data == "true") ? isrtl = true : isrtl = false; 
		}
	});	
		
	getRequest(get_url +"get_eventsource", function(err, data) {			 
		if(!empty(data)){
			for (var i = 0; i < data.length; i++) {
				$("#cal_eventsources").append("<option value="+data[i].source_url+" >"+data[i].source_name+" </option>");
			}
		}
	});	
	
	getRequest(get_url +"get_category", function(err, data) {			 
	
		if(!empty(data)){
			for (var k = 0; k < data.length; k++) {
				$("#cal_category").append("<option id='events_"+data[k].category_id+"' value="+data[k].category_id+">"+data[k].category_name+" ("+data[k].count+")</option>");
			}			
			for (var l = 0; l < data.length; l++) {
				$("#external-events").append("<div class='fc-event' id='"+data[l].category_id+"' style='background-color:"+data[l].backgroundColor+";border-color:"+data[l].borderColor+";color:"+data[l].textColor+"' bgcolor='"+data[l].backgroundColor+"' bcolor='"+data[l].borderColor+"' color='"+data[l].textColor+"' desc='"+data[l].category_desc+"' hash='"+data[l].token+"' >"+data[l].category_name+"</div>");			
				$('#external-events .fc-event').each(function() { 
					// store data so the calendar knows to render an event upon drop
					var eventObject = { 
						id: $.trim(Math.floor((Math.random() * 999) + 10)), // use the element's text as the event title
						title: $.trim($(this).text()), // use the element's text as the event title
						description: $.trim($(this).attr("desc")), // use the element's text as the event description
						category: $.trim($(this).attr("id")), // use the element's text as the event category
						rendering: $.trim(), // use the element's text as the event rendering
						backgroundColor: $.trim($(this).attr("bgcolor")), // use the element's text as the event color rendering
						borderColor: $.trim($(this).attr("bcolor")), // use the element's text as the event color rendering
						textColor: $.trim($(this).attr("color")), // use the element's text as the event color rendering 
						hash: $.trim($(this).attr("hash")), // use the element's text as the event color rendering 
						stick: true // maintain when user navigates (see docs on the renderEvent method)
					};
					
					$(this).data('events', eventObject);
					
					// make the event draggable using jQuery UI
					$(this).draggable({						
						revert: "invalid" , 
						helper: function () { $copy = $(this).clone(); $copy.css({"list-style":"none","width":$(this).outerWidth()}); return $copy; },	 
						appendTo: 'body',
						scroll: false,					
						zIndex: 999,       
						revertDuration: 0			 
					});

				});			 
			}		
			for (var i = 0; i < data.length; i++) {
				$("#marker_category").append("<option id='marker_"+data[i].category_id+"' value="+data[i].category_id+" bgcolor='"+data[i].backgroundColor+"' bcolor='"+data[i].borderColor+"' color='"+data[i].textColor+"' >"+data[i].category_name+" ("+data[i].count+")</option>");
			}		
			for (var j = 0; j < data.length; j++) {
				$("#marker_category2").append("<option id='marker_"+data[j].category_id+"' value="+data[j].category_id+" bgcolor='"+data[j].backgroundColor+"' bcolor='"+data[j].borderColor+"' color='"+data[j].textColor+"'>"+data[j].category_name+" ("+data[j].count+")</option>");
			} 
		}	
	});			
	
	getRequest(get_url +"get_groups", function(err, data) {	
		if(!empty(data)){
			for (var i = 0; i < data.length; i++) {
				$("#ic_event_shareit").append("<option id='shareit_"+data[i].id+"' value="+data[i].id+">"+data[i].name+"</option>");
			}		
			for (var i = 0; i < data.length; i++) {
				$("#ic_event_shareit2").append("<option id='shareit2_"+data[i].id+"' value="+data[i].id+">"+data[i].name+"</option>");
			}	
		}
	});	
	
	getRequest(get_url +"get_usergroups", function(err, data) {	 		
		if(!empty(data)){	
			for (var k = 0; k < data.length; k++) { 
					$("#cal_groups").append("<option id='events_"+data[k].id+"' value="+data[k].id+">"+data[k].name+"</option>"); 
				}	
		}		
	});	
	
	getRequest(get_url +"get_coordinate", function(err, data) {	 
		if(!empty(data)){
			currentCoordinate = $.trim(data);   
			gmaps_add(currentCoordinate);
		}
		
	});		
	
    $("#title").off('keyup drop').on('keyup drop', function (event) {
		var timeoutId = 0;
		clearTimeout(timeoutId); // doesn't matter if it's 0
		timeoutId = setTimeout(function () {
			event.preventDefault();	
			var value = $("#title").val(); 
			
			if(empty(value)) { 
				filterSources[0] = get_url +'json'; 
				$('#calendar').fullCalendar('removeEventSource', eventSources[0]); 
				$('#calendar').fullCalendar('refetchEvents');
				$('#calendar').fullCalendar('addEventSource', filterSources[0]); 
				$('#calendar').fullCalendar('refetchEvents'); 
				eventSources[0] = filterSources[0];  
			}else{ 
				filterSources[0] = get_url +'search?title='+value; 
				$('#calendar').fullCalendar('removeEventSource', eventSources[0]); 
				$('#calendar').fullCalendar('refetchEvents');
				$('#calendar').fullCalendar('addEventSource', filterSources[0]); 
				$('#calendar').fullCalendar('refetchEvents'); 
				eventSources[0] = filterSources[0]; 
			}
		}, true);
				
    });				
			
	$("#submitsearch").on('click', function(e){ 
		e.preventDefault();	
		var value = $("#title").val(); 
		if(empty(value)) { 
			filterSources[0] = get_url +'json'; 
			$('#calendar').fullCalendar('removeEventSource', eventSources[0]); 
			$('#calendar').fullCalendar('refetchEvents');
			$('#calendar').fullCalendar('addEventSource', filterSources[0]); 
			$('#calendar').fullCalendar('refetchEvents'); 
			eventSources[0] = filterSources[0];  
		}else{ 
			filterSources[0] = get_url +'search?title='+value; 
			$('#calendar').fullCalendar('removeEventSource', eventSources[0]); 
			$('#calendar').fullCalendar('refetchEvents');
			$('#calendar').fullCalendar('addEventSource', filterSources[0]); 
			$('#calendar').fullCalendar('refetchEvents'); 
			eventSources[0] = filterSources[0]; 
		}
	});	 
	
	$("#cal_groups").change(function() { 
		var value = $("#cal_groups option:selected").val(); 
		if(empty(value)) { 
			filterSources[0] = get_url +'json'; 
			$('#calendar').fullCalendar('removeEventSource', eventSources[0]); 
			$('#calendar').fullCalendar('refetchEvents');
			$('#calendar').fullCalendar('addEventSource', filterSources[0]); 
			$('#calendar').fullCalendar('refetchEvents'); 
			eventSources[0] = filterSources[0];  
		}else{ 		
			filterSources[0] = get_url +'jsongroups?group='+value; 
			$('#calendar').fullCalendar('removeEventSource', eventSources[0]); 
			$('#calendar').fullCalendar('refetchEvents');
			$('#calendar').fullCalendar('addEventSource', filterSources[0]); 
			$('#calendar').fullCalendar('refetchEvents'); 
			eventSources[0] = filterSources[0];  
		}
	});	
	
	$("#cal_category").change(function() { 
		var value = $("#cal_category option:selected").val(); 
		if(empty(value)) { 
			filterSources[0] = get_url +'json'; 
			$('#calendar').fullCalendar('removeEventSource', eventSources[0]); 
			$('#calendar').fullCalendar('refetchEvents');
			$('#calendar').fullCalendar('addEventSource', filterSources[0]); 
			$('#calendar').fullCalendar('refetchEvents'); 
			eventSources[0] = filterSources[0];  
		}else{ 		
			filterSources[0] = get_url +'jsoncat?category='+value; 
			$('#calendar').fullCalendar('removeEventSource', eventSources[0]); 
			$('#calendar').fullCalendar('refetchEvents');
			$('#calendar').fullCalendar('addEventSource', filterSources[0]); 
			$('#calendar').fullCalendar('refetchEvents'); 
			eventSources[0] = filterSources[0];  
		}
	});
  
	$("#cal_eventsources").change(function() { 
		var value = $("#cal_eventsources option:selected").val(); 
		
		filterSources[1] = {url: value, color: '#fdd017', textColor: '#000', backgroundColor: '#fadf06' }; 
		$('#calendar').fullCalendar('removeEventSource', eventSources[1]); 
		$('#calendar').fullCalendar('refetchEvents');
		$('#calendar').fullCalendar('addEventSource', filterSources[1]); 
		$('#calendar').fullCalendar('refetchEvents');

		eventSources[1] = filterSources[1];  

	});	
	 
	$('.popover-markup>.trigger').popover({
		html: true,
		title: function () {
		return $(this).parent().find('.head').html();
		},
		content: function () {
		return $(this).parent().find('.content').html();
		},
 placement: function(tip, element) {
    var $element, above, actualHeight, actualWidth, below, boundBottom, boundLeft, boundRight, boundTop, elementAbove, elementBelow, elementLeft, elementRight, isWithinBounds, left, pos, right;
    isWithinBounds = function(elementPosition) {
      return boundTop < elementPosition.top && boundLeft < elementPosition.left && boundRight > (elementPosition.left + actualWidth) && boundBottom > (elementPosition.top + actualHeight);
    };
    $element = $(element);
    pos = $.extend({}, $element.offset(), {
      width: element.offsetWidth,
      height: element.offsetHeight
    });
    actualWidth = 283;
    actualHeight = 117;
    boundTop = $(document).scrollTop();
    boundLeft = $(document).scrollLeft();
    boundRight = boundLeft + $(window).width();
    boundBottom = boundTop + $(window).height();
    elementAbove = {
      top: pos.top - actualHeight,
      left: pos.left + pos.width / 2 - actualWidth / 2
    };
    elementBelow = {
      top: pos.top + pos.height,
      left: pos.left + pos.width / 2 - actualWidth / 2
    };
    elementLeft = {
      top: pos.top + pos.height / 2 - actualHeight / 2,
      left: pos.left - actualWidth
    };
    elementRight = {
      top: pos.top + pos.height / 2 - actualHeight / 2,
      left: pos.left + pos.width
    };
    above = isWithinBounds(elementAbove);
    below = isWithinBounds(elementBelow);
    left = isWithinBounds(elementLeft);
    right = isWithinBounds(elementRight);
    if (above) {
      return "top";
    } else {
      if (below) {
        return "bottom";
      } else {
        if (left) {
          return "left";
        } else {
          if (right) {
            return "right";
          } else {
            return "right";
          }
        }
      }
    }
  }		
		
	});  
  
    $(".popover-markup").on("shown.bs.popover",function(){ 

		$('input[class=filter_groups]').change(function() { 
		var vals = new Array(); 
		$("input[id='filter_groups']:checked").each(function (e) {
			var ischecked = (this.checked ?  $(this).val() : "0");	
			vals += (empty(vals) ? ischecked : "," + ischecked);  
		});     
		
		filterSources[0] = get_url +'jsongroups?group='+vals; 
		$('#calendar').fullCalendar('removeEventSource', eventSources[0]); 
		$('#calendar').fullCalendar('refetchEvents');
		$('#calendar').fullCalendar('addEventSource', filterSources[0]); 
		$('#calendar').fullCalendar('refetchEvents'); 
		eventSources[0] = filterSources[0];  
		});	

		$('input[class=filter_category]').change(function() { 
		var vals = new Array(); 
		$("input[id='filter_category']:checked").each(function (e) {
			var ischecked = (this.checked ?  $(this).val() : "0");	
			vals += (empty(vals) ? ischecked : "," + ischecked);  
		});     
		
		filterSources[0] = get_url +'jsoncat?category='+vals; 
		$('#calendar').fullCalendar('removeEventSource', eventSources[0]); 
		$('#calendar').fullCalendar('refetchEvents');
		$('#calendar').fullCalendar('addEventSource', filterSources[0]); 
		$('#calendar').fullCalendar('refetchEvents'); 
		eventSources[0] = filterSources[0];  
		});			
		
		$('input[class=filter_sources]').change(function() { 
		var vals = new Array(); 
		$("input[id='filter_sources']:checked").each(function (e) {
			var ischecked = (this.checked ?  $(this).val() : "0");	
			vals += (empty(vals) ? ischecked : "," + ischecked);  
		});     
		filterSources[1] = {url: vals, color: '#fdd017', textColor: '#000', backgroundColor: '#fadf06' }; 
		$('#calendar').fullCalendar('removeEventSource', eventSources[1]); 
		$('#calendar').fullCalendar('refetchEvents');
		$('#calendar').fullCalendar('addEventSource', filterSources[1]); 
		$('#calendar').fullCalendar('refetchEvents');

		eventSources[1] = filterSources[1];  

		});			
			
		$('#filter_refresh').on('click', function(e0){  				 
			e0.preventDefault();	 
			filterSources[0] = get_url +'json'; 
			$('#calendar').fullCalendar('removeEventSource', eventSources[0]); 
			$('#calendar').fullCalendar('refetchEvents');
			$('#calendar').fullCalendar('addEventSource', filterSources[0]); 
			$('#calendar').fullCalendar('refetchEvents'); 
			eventSources[0] = filterSources[0];  
		});			
		
    });	
	
	eventSources[0] = get_url +"json";  
	eventSources[1] = ''; 
	
	function businessDOW(){ 
		if(empty(businessStart) || empty(businessEnd) || empty(businessdays) ){
			return false;
		}else { 
			return {start: businessStart, end: businessEnd,	dow: [businessdays0, businessdays1, businessdays2, businessdays3, businessdays4,businessdays5,businessdays6 ]};	
		}  		
		return false;
	}
	
	//calendar
	getRequest(get_url +"get_lang", function(err, data) {
		currentLangCode = (!empty(data))? data : currentLangCode;
		moment.defineLocale(currentLangCode, {
		  parentLocale: currentLangCode, 
		});  
		lang = $.extend(cifc.DEFAULTS, cifc.LOCALES[currentLangCode]);
		timedUpdate();
		
		$('#calendar').fullCalendar({ 
			
			defaultDate: $.fullCalendar.moment(),
			defaultView: currentDefaultview, 			
			locale: currentLangCode,
			minTime: ''+mintime+'',
			maxTime: ''+maxtime+'', 			
			aspectRatio: aspectratio, 
			
			timezone: currentTimezoneCode,
			now: currentTimezoneCode,
			weekNumberCalculation: currentTimezoneCode,			
			scrollTime: timescroll,
			
			nowIndicator: nowindicator,
  
			header: {
				left: headerLeft,
				center: headerCenter,
				right: headerRight
			},
			
			buttonIcons: {
				prev: 'left-single-arrow',
				next: 'right-single-arrow',
				prevYear: 'left-double-arrow',
				nextYear: 'right-double-arrow'
			},  
			
			smallTimeFormat: slotformat, // uppercase H for 24-hour clock
			slotLabel: slotlabeling, 
 			
			isRTL: isrtl,
			theme: false, 
			navLinks: navlinks, // can click day/week names to navigate views

			allDaySlot: alldayslot, 
			
			firstDay: firstday,	
			fixedWeekCount: false,	
			weekends: true,
			weekNumbers: weeknumbers1,
			hiddenDays: [hiddenday0,hiddenday1,hiddenday2,hiddenday3,hiddenday4,hiddenday5,hiddenday6],

			businessHours: businessDOW(), // display business hours
			
			googleCalendarApiKey: googlecalendarapikey,
			editable: editable1,
			eventStartEditable: editable1,
			eventDurationEditable: editable1, 			
			
			longPressDelay: longpressdelay,
			selectable: editable1, 	
			selectHelper: true,		
			
			defaultTimedEventDuration: slotduration,
			
			snapDuration: slotduration,
			
			eventLimit: eventlimit1, 
			
			startParam: startdate,
			endParam: enddate, 
			
			eventOrder: eventorder,
			
			dropAccept: '*', 				
			droppable: editable1, // this allows things to be dropped onto the calendar
			
			eventSources: [eventSources[0],eventSources[1]],
			 
			eventRender: function (event, element, view) {
				element.attr('href', 'javascript:void(0);');
				// render the timezone offset below the event title
				if (event.start.hasZone()) {
					element.find('.fc-title').after(
						$('<div class="tzo"/>').text(event.start.format('Z'))
					);
				}				
				element.eq({
					event : event.id, 
					title: event.title, 
					daystart : $.fullCalendar.moment( event.start).format(datetimeformat),
					dayend : $.fullCalendar.moment( event.end).format(datetimeformat),
					backgroundColor: event.backgroundColor,
					borderColor: event.borderColor,
					textColor: event.textColor,
					description: event.description,
					url: event.url,						
					allDay: event.allDay,	
					auth: event.auth,		
					rendering: event.rendering,	
					overlap: event.overlap,	
					recurdays: event.recurdays,	
					recurend: event.recurend,	
					location: event.location,
					latitude: event.longitude,
					longitude: event.longitude,
					category: event.category,
					filename: event.filename
				});
				
			},

			views: {
				basic: {
					// options apply to basicWeek and basicDay views
					slotDuration: slotduration
				},
				agenda: {
					// options apply to agendaWeek and agendaDay views
					slotDuration: slotduration
				},
				week: {
					// options apply to basicWeek and agendaWeek views
					slotDuration: slotduration
				},
				day: {
					// options apply to basicDay and agendaDay views
					slotDuration: slotduration
				}
			}, 
			
			eventResize: function( calEvent, delta, revertFunc, jsEvent, ui, view ){
			
				$params = {
					'event'         : calEvent.id,
					'daystart'      : $.fullCalendar.moment(calEvent.start).format(datetimeformat),
					'dayend'        : (calEvent.end) ? $.fullCalendar.moment(calEvent.end).format(datetimeformat) : $.fullCalendar.moment(calEvent.start).format(datetimeformat),
					'allDay'        : calEvent.allDay,
					'hash'    		: (calEvent.token) ? calEvent.token : ''
				};
				
				$.ajax({
					url     : get_url +'resize',
					cache   : true,
					type    : 'POST',
					data    : $params,
					complete: function(data){
						return;
					}
				});
			},
			
			dragOpacity: function( calEvent, delta, revertFunc, jsEvent, ui, view ){
			
				$params = {
					'event'         : calEvent.id,
					'daystart'      : $.fullCalendar.moment(calEvent.start).format(datetimeformat),
					'dayend'        : (calEvent.end) ? $.fullCalendar.moment(calEvent.end).format(datetimeformat) : $.fullCalendar.moment(calEvent.start).format(datetimeformat),
					'allDay'        : calEvent.allDay,
					'hash'          : (calEvent.token) ? calEvent.token : ''
				};
				
				$.ajax({
					url     : get_url +'resize',
					cache   : true,
					type    : 'POST',
					data    : $params,
					complete: function(data){
						return;
					}
				});
			},   
			
			eventDrop: function( calEvent, delta, revertFunc, jsEvent, ui, view ){
				$params = {
					'event'         : calEvent.id,
					'daystart'      : (calEvent.start) ? $.fullCalendar.moment(calEvent.start).format(datetimeformat) : $.fullCalendar.moment(delta).format(datetimeformat),
					'dayend'        : (calEvent.end) ? $.fullCalendar.moment(calEvent.end).format(datetimeformat) : $.fullCalendar.moment(calEvent.start).format(datetimeformat),
					'allDay'        : calEvent.allDay,
					'hash'          : (calEvent.token) ? calEvent.token : ''
				};
	
				$.ajax({
					url     : get_url +'drop_event/',
					type    : 'POST',
					data    : $params,           
					complete: function(data){
						return;
					}
				});
			},
			
			drop: function( date, jsEvent, ui, resourceId )  {
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('events');
    
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}
				 
				$params = {
					'id'         : originalEventObject.id,
					'category'   : originalEventObject.category,
					'title'      : originalEventObject.title,
					'description': originalEventObject.description,
					'rendering'  : originalEventObject.rendering,
					'backgroundColor'  : originalEventObject.backgroundColor,
					'borderColor'      : originalEventObject.borderColor,
					'textColor'        : originalEventObject.textColor,
					'start'      : $.fullCalendar.moment(date).format(datetimeformat),
					'end'        : $.fullCalendar.moment(date).format(datetimeformat),
					'allDay'     : (date.hasTime())? false : true, 
					'hash'       : originalEventObject.hash,
				};
 
				$.ajax({
					url     : get_url +'drag_event',
					type    : 'POST',
					data    : $params,            
					complete: function(data){ 
						$('#calendar').fullCalendar('removeEvents');
						$('#calendar').fullCalendar('refetchEvents');
						alert(lang.dragMsg);
					}
				});	 
				$("#calendar").fullCalendar('renderEvent',
				{ 
					category: originalEventObject.category,
					title: originalEventObject.title,
					description: originalEventObject.description,
					rendering: originalEventObject.rendering,
					backgroundColor: originalEventObject.backgroundColor,
					borderColor: originalEventObject.borderColor,
					textColor: originalEventObject.textColor,  
					start: $.fullCalendar.moment(date).format(datetimeformat),
					end: $.fullCalendar.moment(date).format(datetimeformat),
					allDay: originalEventObject.allDay,
					hash: originalEventObject.hash,
				},
				true);	
			},
			
			select: function( start, end, jsEvent, view ) { 
			
				var starttime = (start) ? $.fullCalendar.moment(start).format(datetimeformat) : $.fullCalendar.moment().format(datetimeformat);
				var endtime   = (end) ? $.fullCalendar.moment(end).format(datetimeformat) : $.fullCalendar.moment(start).format(datetimeformat);
				var today   = $.fullCalendar.moment(starttime).format(dateformat);
				var etoday   = $.fullCalendar.moment(endtime).format(dateformat);
				var stime   = $.fullCalendar.moment(starttime).format(timeformat);
				var etime   = $.fullCalendar.moment(endtime).format(timeformat);
				var showend = (today < etoday) ? $.fullCalendar.moment(endtime).format(datetimeaformat) : $.fullCalendar.moment(endtime).format(timeaformat);
									
				var duration = $.fullCalendar.moment(starttime).format(datetimeaformat) + " - " + showend;  			
				var currentLocale = currentLangCode; 
				
				$.getJSON(get_url +"get_category", function(data) { 
					var cat = data; 
					for (var i = 1; i < cat.length; i++) { 
				    	$("#createEventModal #marker_"+ cat[i].category +"").attr("selected","true"); 
					}   
					$( "#createEventModal #marker_category" ).change(function () {
						var bg = "", b = "", c = "";
						$( "#createEventModal #marker_category option:selected" ).each(function() {
						  bg += $.trim($(this).attr("bgcolor"));
						  b += $.trim($(this).attr("bcolor"));
						  c += $.trim($(this).attr("color"));
						}); 
						$('#createEventModal #ic_event_bgcolor').minicolors('value', bg);
						$('#createEventModal #ic_event_bordercolor').minicolors('value', b);
						$('#createEventModal #ic_event_textcolor').minicolors('value', c); 
					}).change(); 
				});					
				
				$.getJSON(get_url +"get_category", function(data) { 	  
					var data = data; 
					for (var i = 1; i < data.length; i++) { 
				    	$("#createEventModal #marker_"+ data[i].category +"").attr("selected","true");
					} 
				});	
				
				$.getJSON(get_url +"get_coordinate", function(data) { 	 	 
					var data2 = data;
					currentCoordinate = data2; 
					var coor = currentCoordinate.split(',');
					var lat = coor[0];
					var lng = coor[1];  
					$('#createEventModal #markers_clat').val(lat),
					$('#createEventModal #markers_clng').val(lng), 
					gmaps_add(currentCoordinate); 
				});		
				
				$('#createdtp1').datetimepicker({ 
					timeZone: currentTimezoneCode2,
					locale: currentLocale,
					defaultDate: starttime,
					format: datetimeaformat2,	 		
					toolbarPlacement: 'top',							
					widgetPositioning: {horizontal: 'auto', vertical: 'top'}
				});			
				
				$('#createdtp2').datetimepicker({ 
					timeZone: currentTimezoneCode2,
					locale: currentLocale,  
					defaultDate: endtime, 
					useCurrent: false,
					format: datetimeaformat2, 						
					toolbarPlacement: 'top',							
					widgetPositioning: {horizontal: 'auto', vertical: 'top'}
				});
				
				$('#createdtp3').datetimepicker({ 
					timeZone: currentTimezoneCode2,
					locale: currentLocale, 
					defaultDate: starttime,
					viewMode: viewmode,
					format: dateformat
				}); 
				
				$("#createdtp1").on("dp.change", function (e) {
					$('#createdtp2').data("DateTimePicker").minDate(e.date);
					if(stime == $.fullCalendar.moment(e.date).format(timeformat)) { 
					$('input:radio[name="ic_event_allday"][value="true"]').prop('checked', true);    
					}else {  
					$('input:radio[name="ic_event_allday"][value="false"]').prop('checked', true);   
					} 				
				 				
				});
				$("#createdtp2").on("dp.change", function (e) {
					$('#createdtp1').data("DateTimePicker").maxDate(e.date);
					if(etime == $.fullCalendar.moment(e.date).format(timeformat)) {
					$('input:radio[name="ic_event_allday"][value="true"]').prop('checked', true);    
					}else {
					$('input:radio[name="ic_event_allday"][value="false"]').prop('checked', true);   	 
					} 				
				 
				});							 
  				 	
					
				$('#createEventModal #ic_event_title').val('');
				$('#createEventModal #ic_event_desc').val('');
				$('#createEventModal #ic_event_starttime').val($.fullCalendar.moment(starttime).format(datetimeaformat2));
				$('#createEventModal #ic_event_endtime').val($.fullCalendar.moment(endtime).format(datetimeaformat2)); 
				$('input:radio[id="ic_event_alldayF"][value="true"]').prop('checked', true);  
				$('#createEventModal #ic_event_urllink').val('');  
				$('#createEventModal #ic_event_endrecurring').val('');
				$('#createEventModal #ic_event_eventoverlap').val('true');
				$('#createEventModal #ic_event_clocation').val(''); 
				$('#createEventModal #when').text(duration);     
				$('#createEventModal #userfile1').val('');     
				$('#createEventModal #userfile2').val('');     
				$('#createEventModal').modal('show'); 
				
			},

			eventClick: function(calEvent, jsEvent, view)  { 		 
			
				if(editable1) {
					var starttime = (calEvent.start) ? $.fullCalendar.moment(calEvent.start).format(datetimeformat) : $.fullCalendar.moment().format(datetimeformat);
					var endtime   = (calEvent.end) ? $.fullCalendar.moment(calEvent.end).format(datetimeformat) : $.fullCalendar.moment(calEvent.start).format(datetimeformat);
					var today   = $.fullCalendar.moment(starttime).format(dateformat);
					var etoday   = $.fullCalendar.moment(endtime).format(dateformat);	 
					var stime   = $.fullCalendar.moment(starttime).format(timeformat);
					var etime   = $.fullCalendar.moment(endtime).format(timeformat);	
					
					var showend = (today < etoday) ? $.fullCalendar.moment(endtime).format(datetimeaformat) : $.fullCalendar.moment(endtime).format(timeaformat); 
					var duration = $.fullCalendar.moment(starttime).format(datetimeaformat) + " - " + showend;  
					var attach = (calEvent.filename) ? '<a href="' + attached_url + '' + calEvent.filename + '" title="' + calEvent.filename + '" target="_blank"><b>' + calEvent.filename + '</b></a>' : '';
					
					var uname = (!empty(calEvent.username)) ? '<a href="' + siteurl + '' + calEvent.username + '" title="' + calEvent.username + '" target="_blank"><b>' + calEvent.username + '</b></a>' : '';
					
					var ulat = parseFloat(calEvent.latitude).toFixed(15); 
					var ulng = parseFloat(calEvent.longitude).toFixed(15); 

					var currentLocale2 = currentLangCode;
					
					gmaps_update(ulat, ulng);
					var minsDuration = ( endtime - starttime ) / 60 / 1000;
					var durationString = ((minsDuration / 60) + (minsDuration%60)).toString();  
				
					$.getJSON(get_url +"get_category", function(data) {    
						for (var i = 0; i < data.length; i++) {
							if(data[i].category == calEvent.category ) {
								$("#updateEventModal #marker_"+ data[i].category +"").removeAttr("selected");
								$("#updateEventModal #marker_"+ data[i].category +"").attr("selected","true");
							}else {
								$("#updateEventModal #marker_"+ data[i].category +"").removeAttr("selected");
							}
						} 
					});	  
					
					$("#updateEventModal #marker_category2").change(function () {
						var bg = "", b = "", c = "";
						$( "#updateEventModal #marker_category2 option:selected" ).each(function() {
						  bg += $.trim($(this).attr("bgcolor"));
						  b += $.trim($(this).attr("bcolor"));
						  c += $.trim($(this).attr("color"));
						}); 
						$('#updateEventModal #ic_event_bgcolor').minicolors('value', bg);
						$('#updateEventModal #ic_event_bordercolor').minicolors('value', b);
						$('#updateEventModal #ic_event_textcolor').minicolors('value', c); 
					}).change(); 					
				
					$('#updatedtp1').datetimepicker({ 
						timeZone: currentTimezoneCode2,
						locale: currentLocale2,
						defaultDate: starttime,
						format: datetimeaformat2, 
						toolbarPlacement: 'top',							
						widgetPositioning: {horizontal: 'auto', vertical: 'top'}
					});
					$('#updatedtp2').datetimepicker({ 
						timeZone: currentTimezoneCode2,
						locale: currentLocale2,
						defaultDate: endtime,
						format: datetimeaformat2, 
						useCurrent: false,
						toolbarPlacement: 'top',							
						widgetPositioning: {horizontal: 'auto', vertical: 'top'}
					});
					$('#updatedtp3').datetimepicker({ 
						timeZone: currentTimezoneCode2,
						locale: currentLocale2,
						defaultDate: starttime,
						viewMode: viewmode,
						format: dateformat
					});	  
			
					$("#ic_event_shareit2").on("changed.bs.select", function (e) {
						var id = "";
						$( "#updateEventModal #ic_event_shareit2 option:selected" ).each(function() {
						  id += $.trim($(this).attr("id")); 
						}); 
						$('#updateEventModal #ic_event_shareitg2').val(id);  
					});			
		
					$("#updatedtp1").on("dp.change", function (e) {
						$('#updatedtp2').data("DateTimePicker").minDate(e.date); 
						if(stime == $.fullCalendar.moment(e.date).format(timeformat)) {$("#updateEventModal #ic_event_alldayF").removeAttr("checked"); $("#updateEventModal #ic_event_alldayT").attr("checked","true");}else {$('#updateEventModal #ic_event_alldayT').removeAttr("checked");$('#updateEventModal #ic_event_alldayF').attr("checked","true");} 	
					});
					$("#updatedtp2").on("dp.change", function (e) {
						$('#updatedtp1').data("DateTimePicker").maxDate(e.date);
						if(etime == $.fullCalendar.moment(e.date).format(timeformat)) {$("#updateEventModal #ic_event_alldayF").removeAttr("checked"); $("#updateEventModal #ic_event_alldayT").attr("checked","true");}else {$('#updateEventModal #ic_event_alldayT').removeAttr("checked");$('#updateEventModal #ic_event_alldayF').attr("checked","true");} 	
					});
				
					$('#updateEventModal #gexport').html('<a href="//www.google.com/calendar/event?action=TEMPLATE&amp;text='+ calEvent.title +
					'&amp;dates='+ $.fullCalendar.moment(starttime).format(datetimetzformat) +
					'/'+ $.fullCalendar.moment(endtime).format(datetimetzformat) +
					'&amp;details='+ calEvent.description +
					'&amp;location='+ calEvent.location +
					'&amp;url='+ calEvent.url +
					'&amp;sprop=website:" title="'+ lang.linktog +'" target="_blank"> '+ lang.linktog +'</a>' );

					$('#updateEventModal #yexport').html("<a href='//calendar.yahoo.com/?v=60" +
					"&DUR=" + durationString.substr(0,2) +
					"&TITLE=" + calEvent.title +
					"&ST=" + $.fullCalendar.moment(starttime).format(datetimetzformat) +
					"&in_loc=" + calEvent.location +
					"&DESC=" + calEvent.description +
					"&URL=" + calEvent.url + "' title='"+ lang.linktoy +"' target='_blank' > "+ lang.linktoy +"</a>"	);

					$('#updateEventModal #lexport').html("<a href='//calendar.live.com/calendar/calendar.aspx?rru=addevent" +
					"&dtstart=" + starttime +
					"&dtend=" + endtime +
					"&summary=" + calEvent.title +
					"&description=" + calEvent.description +
					"&url=" + calEvent.url +
					"&location=" + calEvent.location + "' title='"+ lang.linktol +"' target='_blank' > "+ lang.linktol +"</a>"	); 				
					
					$('#updateEventModal #Iexport').html("<a href='"+ get_url +"export/" +
					"" + calEvent.id + "' title='"+ lang.linktoi +"' > "+ lang.linktoi +"</a>"	); 
 
					if((calEvent.recurdays) == 0) {$('#updateEventModal #ic_event_recurringnone').attr("selected","true");$('#updateEventModal #ic_event_recurringdaily').removeAttr("selected");$('#updateEventModal #ic_event_recurring2weeks').removeAttr("selected");$('#updateEventModal #ic_event_recurringweekly').removeAttr("selected");$('#updateEventModal #ic_event_recurringmonthly').removeAttr("selected");$('#updateEventModal #ic_event_recurringyearly').removeAttr("selected");}else if((calEvent.recurdays) == 1) {	$('#updateEventModal #ic_event_recurringnone').removeAttr("selected");$('#updateEventModal #ic_event_recurringdaily').attr("selected","true");$('#updateEventModal #ic_event_recurring2weeks').removeAttr("selected");$('#updateEventModal #ic_event_recurringweekly').removeAttr("selected");$('#updateEventModal #ic_event_recurringmonthly').removeAttr("selected");$('#updateEventModal #ic_event_recurringyearly').removeAttr("selected");}else if((calEvent.recurdays) == 7) {$('#updateEventModal #ic_event_recurringnone').removeAttr("selected");$('#updateEventModal #ic_event_recurringdaily').removeAttr("selected");$('#updateEventModal #ic_event_recurring2weeks').removeAttr("selected");$('#updateEventModal #ic_event_recurringweekly').attr("selected","true");$('#updateEventModal #ic_event_recurringmonthly').removeAttr("selected");$('#updateEventModal #ic_event_recurringyearly').removeAttr("selected");}else if((calEvent.recurdays) == 14) {$('#updateEventModal #ic_event_recurringnone').removeAttr("selected");	$('#updateEventModal #ic_event_recurringdaily').removeAttr("selected");	$('#updateEventModal #ic_event_recurring2weeks').attr("selected","true");$('#updateEventModal #ic_event_recurringweekly').removeAttr("selected");$('#updateEventModal #ic_event_recurringmonthly').removeAttr("selected");$('#updateEventModal #ic_event_recurringyearly').removeAttr("selected");} else if((calEvent.recurdays) == 30) {$('#updateEventModal #ic_event_recurringnone').removeAttr("selected");	$('#updateEventModal #ic_event_recurringdaily').removeAttr("selected");	$('#updateEventModal #ic_event_recurring2weeks').removeAttr("selected");$('#updateEventModal #ic_event_recurringweekly').removeAttr("selected");$('#updateEventModal #ic_event_recurringmonthly').attr("selected","true");$('#updateEventModal #ic_event_recurringyearly').removeAttr("selected");} else if((calEvent.recurdays) == 365) {$('#updateEventModal #ic_event_recurringnone').removeAttr("selected");$('#updateEventModal #ic_event_recurringdaily').removeAttr("selected");$('#updateEventModal #ic_event_recurring2weeks').removeAttr("selected");$('#updateEventModal #ic_event_recurringweekly').removeAttr("selected");	$('#updateEventModal #ic_event_recurringmonthly').removeAttr("selected");$('#updateEventModal #ic_event_recurringyearly').attr("selected","true");}			
					
					if((calEvent.rendering) == "") {$('#updateEventModal #ic_event_renderingB').removeAttr("selected");$('#updateEventModal #ic_event_renderingF').attr("selected","true");}else {$('#updateEventModal #ic_event_renderingF').removeAttr("selected");$('#updateEventModal #ic_event_renderingB').attr("selected","true");}
					if((calEvent.overlap) == false) {$('#updateEventModal #ic_event_eventoverlapT').removeAttr("selected");$('#updateEventModal #ic_event_eventoverlapF').attr("selected","true");}else {$('#updateEventModal #ic_event_eventoverlapF').removeAttr("selected");$('#updateEventModal #ic_event_eventoverlapT').attr("selected","true");} 
									 
					$('#updateEventModal #eid').val(calEvent.eid);			
					$('#updateEventModal #apptID').val(calEvent.id);			
					$('#updateEventModal #ic_event_bgcolor').minicolors('value', calEvent.backgroundColor);
					$('#updateEventModal #ic_event_bordercolor').minicolors('value', calEvent.textColor);
					$('#updateEventModal #ic_event_textcolor').minicolors('value', calEvent.borderColor);
					$('#updateEventModal #ic_event_title').val(calEvent.title);
					$('#updateEventModal #ic_event_desc').val(calEvent.description);
					$('#updateEventModal #ic_event_starttime').val($.fullCalendar.moment(starttime).format(datetimeaformat2));
					$('#updateEventModal #ic_event_endtime').val($.fullCalendar.moment(endtime).format(datetimeaformat2)); 
				    $('input:radio[name="ic_event_allday"][value="'+ calEvent.allDay +'"]').prop('checked', true);   
					$('#updateEventModal #ic_event_urllink').val(calEvent.url); 
					$('#updateEventModal #ic_event_shareit2').selectpicker('val', calEvent.gid);
					$('#updateEventModal #ic_event_endrecurring').val(calEvent.recurend);  
					$('#updateEventModal #ic_event_ulocation').val(calEvent.location); 
					$('#updateEventModal #markers_ulng').val(calEvent.longitude); 
					$('#updateEventModal #markers_ulat').val(calEvent.latitude);  
					$('#updateEventModal #marker_category2').val(calEvent.category);
					$('#updateEventModal #show_ulat').text(calEvent.longitude); 
					$('#updateEventModal #show_ulng').text(calEvent.latitude);  
					$('#updateEventModal #filename').html(attach);
					$('#updateEventModal #who').html(uname);   
					$('#updateEventModal #when').text(duration);   
					$('#updateEventModal #event_title').text(calEvent.title);   
					$('#updateEventModal').modal('show');  
				}else{return false;}
			},  
	  
			loading: function(bool) {
				$('#loading').toggle(bool); 
			} 
			
		}); 
		
	}); 
	 
	 
	$('#cifcv').text($.cifullCalendar.version); 
	$('#fcv').text($.fullCalendar.version); 
	
 	$('#loadEvents').on('click', function(e0){  				 
		e0.preventDefault();	 
		$('#calendar').fullCalendar('removeEvents');
		$('#calendar').fullCalendar('refetchEvents');
	});	

 	$('#printEvents').on('click', function(p1){ 	
		 p1.preventDefault();
		 window.print();
	});	
 	
	$('#delButton').on('click', function(d1){  
		d1.preventDefault();	 
			$("#updateEventModal").modal('hide'); 
			 
			var fd = new FormData($("form#form2")[0]);    
			
		   	$.ajax({
				type: "POST",
				url: get_url +"delete_event",
				
				xhr: function() {  // Custom XMLHttpRequest
				var myXhr = $.ajaxSettings.xhr();
					if(myXhr.upload){ // Check if upload property exists
						myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // For handling the progress of the upload
					}
				return myXhr;
				}, 

				//Before 1.5.1 you had to do this:
				beforeSend: function (x) {
					if (x && x.overrideMimeType) {
						x.overrideMimeType("multipart/form-data");
					}
				},
				// Now you should be able to do this:
				mimeType: 'multipart/form-data',    //Property added in 1.5.1
		
				// Form data
				data: fd,
				//Options to tell jQuery not to process data or worry about content-type.
				cache: false,
				contentType: false,
				processData: false,	
				
				error: function(xhr, status, error) { 
					alert(lang.Err);
				},						
				complete:function(data){ 	
					$('#calendar').fullCalendar('removeEvents');
					$('#calendar').fullCalendar('refetchEvents');		
					alert(lang.delMsg);		
				} 
      		});		 
			
	}); 
	
	$('#updateButton').on('click', function(e){  
 		
		var title = $("#updateEventModal #ic_event_title" ).val(); 
		var backgroundcolor = $('#updateEventModal #ic_event_bgcolor').val();
		var bordercolor = $('#updateEventModal #ic_event_textcolor').val();
		var textcolor = $('#updateEventModal #ic_event_bordercolor').val();
		var description = $('#updateEventModal #ic_event_desc').val();
		var share = $('#updateEventModal #ic_event_shareit2').val();
		var url = $('#updateEventModal #ic_event_urllink').val();
		var allday = $("input[name=ic_event_allday]:checked", "#updateEventModal").val(); 
		var category = $('#updateEventModal #marker_category2').val(); 
		var overlap = $('#updateEventModal #ic_event_eventoverlap').val(); 
		var recur = $('#updateEventModal #ic_event_recurring').val(); 
		var endrecur = $('#updateEventModal #ic_event_endrecurring').val(); 		
		var location = $('#updateEventModal #ic_event_ulocation').val();
		var latitude = $('#updateEventModal #markers_ulat').val();
		var longitude = $('#updateEventModal #markers_ulng').val();
		var start = $.fullCalendar.moment($('#updateEventModal #ic_event_starttime').val()).format(datetimeformat);
		var end = $.fullCalendar.moment($('#updateEventModal #ic_event_endtime').val()).format(datetimeformat);					
					
		if(empty(title) || empty(category)) {
			e.preventDefault();	
			alert(lang.Err);
		}else if(recur > 0 && empty(endrecur)) {
			e1.preventDefault();	
			alert(lang.recurMsg);
		}else{		
			e.preventDefault();	 
			$("#updateEventModal").modal('hide');  

			var fd = new FormData($("form#form2")[0]);    
 
		   	$.ajax({
				type: "POST",
				url: get_url +"update_event", 

				xhr: function() {  // Custom XMLHttpRequest
				var myXhr = $.ajaxSettings.xhr();
					if(myXhr.upload){ // Check if upload property exists
						myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // For handling the progress of the upload
					}
				return myXhr;
				}, 

				//Before 1.5.1 you had to do this:
				beforeSend: function (x) {
					if (x && x.overrideMimeType) {
						x.overrideMimeType("multipart/form-data");
					}
				},
				// Now you should be able to do this:
				mimeType: 'multipart/form-data',    //Property added in 1.5.1
		
				// Form data
				data: fd,
				//Options to tell jQuery not to process data or worry about content-type.
				cache: false,
				contentType: false,
				processData: false,	
				
				error: function(xhr, status, error) {
					alert(lang.Err); 
				},						
				complete:function(data){ 				
					$('#calendar').fullCalendar('removeEvents');
					$('#calendar').fullCalendar('refetchEvents');
					if(share < 0) {alert(lang.publicMsg)}else{alert(lang.updateMsg);}	
				} 
      		});
					
 			$("#calendar").fullCalendar('updateEvent',	{  
				title: title,
				backgroundColor: backgroundcolor,
				borderColor: bordercolor,
				textColor: textcolor,
				description: description, 
				url: url,
				allDay: allday,  
				auth: share,							
				overlap: overlap,							
				recurdays: recur,							
				recurend: endrecur,							
				location: location,
				latitude: latitude,
				longitude: longitude,
				category: category,	
				start: start,
				end: end, 
			},
			true); 
		}	
	});	 
	
	$('#addButton').on('click', function(e1){ 
	
		var title = $("#createEventModal #ic_event_title" ).val(); 
		var backgroundcolor = $('#createEventModal #ic_event_bgcolor').val();
		var bordercolor = $('#createEventModal #ic_event_textcolor').val();
		var textcolor = $('#createEventModal #ic_event_bordercolor').val();
		var description = $('#createEventModal #ic_event_desc').val();
		var share = $('#createEventModal #ic_event_shareit').val();
		var url = $('#createEventModal #ic_event_urllink').val();
		var allday = $("input[name=ic_event_allday]:checked", "#createEventModal").val(); 
		var category = $('#createEventModal #marker_category').val(); 
		var overlap = $('#createEventModal #ic_event_eventoverlap').val(); 
		var recur = $('#createEventModal #ic_event_recurring').val(); 
		var endrecur = $('#createEventModal #ic_event_endrecurring').val(); 		
		var location = $('#createEventModal #ic_event_ulocation').val();
		var latitude = $('#createEventModal #markers_ulat').val();
		var longitude = $('#createEventModal #markers_ulng').val();
		var start = $.fullCalendar.moment($('#createEventModal #ic_event_starttime').val()).format(datetimeformat);
		var end = $.fullCalendar.moment($('#createEventModal #ic_event_endtime').val()).format(datetimeformat);
					
		if(empty(title) || empty(category)) {
			e1.preventDefault();	
			alert(lang.Err);
		}else if(recur > 0 && empty(endrecur)) {
			e1.preventDefault();	
			alert(lang.recurMsg);
		}else{	
			e1.preventDefault();
			$("#createEventModal").modal('hide'); 
			 
			var fd = new FormData($("form#form1")[0]);    
			
		   	$.ajax({
				type: "POST",
				url: get_url +"add_event",
				
				xhr: function() {  // Custom XMLHttpRequest
				var myXhr = $.ajaxSettings.xhr();
					if(myXhr.upload){ // Check if upload property exists
						myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // For handling the progress of the upload
					}
				return myXhr;
				}, 

				//Before 1.5.1 you had to do this:
				beforeSend: function (x) {
					if (x && x.overrideMimeType) {
						x.overrideMimeType("multipart/form-data");
					}
				},
				// Now you should be able to do this:
				mimeType: 'multipart/form-data',    //Property added in 1.5.1
		
				// Form data
				data: fd,
				//Options to tell jQuery not to process data or worry about content-type.
				cache: false,
				contentType: false,
				processData: false,	
				
				error: function(xhr, status, error) { 
					alert(lang.Err);	
				},			
				complete:function(data){ 	
					$('#calendar').fullCalendar('removeEvents');
					$('#calendar').fullCalendar('refetchEvents');	
					if(share < 0) {alert(lang.publicMsg)}else{alert(lang.addMsg);}	
				} 
      		});		
			
			$("#calendar").fullCalendar('renderEvent', { 
				title: title,
				backgroundColor: backgroundcolor,
				borderColor: bordercolor,
				textColor: textcolor,
				description: description, 
				url: url,
				allDay: allday,  
				auth: share,						
				overlap: overlap,
				recurdays: recur,							
				recurend: endrecur,					
				location: location,
				latitude: latitude,
				longitude: longitude,
				category: category,	
				start: start,
				end: end,
			},
			true);			
		}
	}); 	 

	$('#uploadButton').on('click', function(e2){  
		e2.preventDefault();	 
			$("#upload").modal('hide'); 
			 
			var fd = new FormData($("form#upload_file")[0]);    
			
		   	$.ajax({
				type: "POST",
				url: get_url +"upload_file",
				
				xhr: function() {  // Custom XMLHttpRequest
				var myXhr = $.ajaxSettings.xhr();
					if(myXhr.upload){ // Check if upload property exists
						myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // For handling the progress of the upload
					}
				return myXhr;
				}, 

				//Before 1.5.1 you had to do this:
				beforeSend: function (x) {
					if (x && x.overrideMimeType) {
						x.overrideMimeType("multipart/form-data");
					}
				},
				// Now you should be able to do this:
				mimeType: 'multipart/form-data',    //Property added in 1.5.1
		
				// Form data
				data: fd,
				//Options to tell jQuery not to process data or worry about content-type.
				cache: false,
				contentType: false,
				processData: false,	
				
				error: function(xhr, status, error) { 
					alert(lang.Err);
				},				
				complete:function(xhr, status, error) { 
					$('#calendar').fullCalendar('removeEvents');
					$('#calendar').fullCalendar('refetchEvents');
					alert(lang.uploadMsg);			
				} 
      		});		
  	 
	}); 	
	
	function alert(message){
		$("#alertShow").fadeIn();
		$("#alertShow").html(message);
		window.setTimeout(function () {$("#alertShow").fadeOut(300)}, 4000);
	} 
	
	function progressHandlingFunction(e){
		if(e.lengthComputable){
			$('progress').attr({value:e.loaded,max:e.total});
		}
	} 
		
    function updateSnippets () {
        var i;
		 
		moment.defineLocale(currentLangCode, {
		  parentLocale: currentLangCode, 
		});  		
		moment.tz(currentTimezoneCode2).format(monthdayformat);

        for (i = 0; i < snippets.length; i++) {
            snippets[i].render();
        }
    }
 		
	function updateClock(){

        var now = moment.tz(currentTimezoneCode2);
        var second = now.format(secformat) * 6;
        var minute = now.format(minformat) * 6 + second / 60;
        var hour = ((now.format(hourformat) % 12) / 12) * 360 + 90 + minute / 12;
 
		updateSnippets();
		var tzone = now.format(monthdayformat);
		var ampm = now.format(ampmformat);
		var digiclock = now.format(clockformat);
	
        $('#hour').css("transform", "rotate(" + hour + "deg)");
        $('#minute').css("transform", "rotate(" + minute + "deg)");
        $('#second').css("transform", "rotate(" + second + "deg)");
		$('#ampm').text(ampm);
		$('#date').text(tzone);
		$('#timezone').text(currentTimezoneCode2);
		$('#digiclock').text(digiclock);
    }

    function timedUpdate () {
        updateClock();
        updateSnippets();
        setTimeout(timedUpdate, 1000);
    }
  
	function initialise_color_pickers(){ 
		//Initialise color pickers
		$('.color_picker').each( function() {
			$(this).minicolors({
				control: $(this).attr('data-control') || 'hue',
				defaultValue: $(this).attr('data-defaultValue') || '',
				inline: $(this).attr('data-inline') === 'true',
				letterCase: $(this).attr('data-letterCase') || 'lowercase',
				opacity: $(this).attr('data-opacity'),
				position: $(this).attr('data-position') || 'bottom left',
				change: function(hex, opacity) {
					if( !hex ) return;
					if( opacity ) hex += ', ' + opacity;
				},
				theme: 'bootstrap'
			});

		});		
	} 

	function empty(v) { 
		var t = typeof v; 
		return t === 'undefined' || ( t === 'object' ? ( v === null || Object.keys( v ).length === 0 ) : [false, 0, "", "0"].indexOf( v ) >= 0 ); 
	};
	
	function is_string(v) { 
	  return (typeof v === 'string');
	}				

	function geocodePosition(pos) {
	  geocoder.geocode({
		latLng: pos
	  }, function(responses) {
		if (responses && responses.length > 0) {
		  updateMarkerAddress(responses[0].formatted_address,pos.lat(),pos.lng());
		} else {
		  updateMarkerAddress('location unknown.');
		}
	  });
	}

	function updateMarkerAddress(address,lat,lng) {
	  $("#ic_event_clocation").val(address); 
	  $("#ic_event_clocation").attr("class","form-control"); 
	  $("#markers_clat").val(lat);
	  $("#show_clat").html(lat);
	  $("#markers_clng").val(lng);
	  $("#show_clng").html(lng);
	}
	
	function geocodePosition2(pos) {
	  geocoder.geocode({
		latLng: pos
	  }, function(responses) {
		if (responses && responses.length > 0) {
		  updateMarkerAddress2(responses[0].formatted_address,pos.lat(),pos.lng());
		} else {
		  updateMarkerAddress2('location unknown.');
		}
	  });
	}

	function updateMarkerAddress2(address,lat,lng) {
	  $("#ic_event_ulocation").val(address); 
	  $("#ic_event_ulocation").attr("class","form-control"); 
	  $("#markers_ulat").val(lat);
	  $("#show-lat").html(lat);
	  $("#markers_ulng").val(lng);
	  $("#show-lng").html(lng);
	}

	function gmaps_update(ulat, ulng) {
		
		$("#ic_event_ulocation").attr("class","form-control"); 
		
		var latLng = new google.maps.LatLng(ulat, ulng);

		var mapOptions = {
		center: latLng,
		zoomControl: true,
		zoom: 19,	
		mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById('gmapsCanvas2'),
		mapOptions);
	 
		$("#ic_event_ulocation").keypress(function(e) {
			if (e.which == 13) {
				e.preventDefault();
			}
		});	

		var uinput = (document.getElementById('ic_event_ulocation'));
		var autocomplete = new google.maps.places.Autocomplete(uinput);

		autocomplete.bindTo('bounds', map);

		var infowindow = new google.maps.InfoWindow();
		var marker = new google.maps.Marker({
			position: latLng,
			map: map,
			draggable: true
		});

		google.maps.event.addListener(map, 'idle', function(){
			google.maps.event.trigger(map, 'resize'); 
			map.setZoom( map.getZoom() - 1);
			map.setZoom( map.getZoom() + 1); 
		});	 
				
		google.maps.event.addListenerOnce(map,'center_changed', function() {
			window.setTimeout(function() {
			  map.panTo(marker.getPosition());
			}, 500);
		});
		  
		google.maps.event.addListener(marker, 'dragend', function() {
			geocodePosition2(marker.getPosition());
		});
		
		google.maps.event.addListener(autocomplete, 'place_changed', function() {
			infowindow.close();
			marker.setVisible(false);
			uinput.className = '';
			var place = autocomplete.getPlace();
			if (!place.geometry) { 
			  uinput.className = 'notfound';
			  return;
			}
		 
			if (place.geometry.viewport) {
			  map.fitBounds(place.geometry.viewport);
			} else {
			  map.setCenter(place.geometry.location);
			  map.setZoom(13); 
			}
			marker.setIcon(/** @type {google.maps.Icon} */({
			  url: place.icon,
			  size: new google.maps.Size(71, 71),
			  origin: new google.maps.Point(0, 0),
			  anchor: new google.maps.Point(17, 34),
			  scaledSize: new google.maps.Size(35, 35)
			}));
			marker.setPosition(place.geometry.location);
			marker.setVisible(true);
			geocodePosition2(marker.getPosition());
			var address = '';
			if (place.address_components) {
			  address = [
				(place.address_components[0] && place.address_components[0].short_name || ''),
				(place.address_components[1] && place.address_components[1].short_name || ''),
				(place.address_components[2] && place.address_components[2].short_name || '')
			  ].join(' ');
			}
			
			infowindow.setContent('<strong><u>' + place.name + '</u></strong><br>' + address);
			infowindow.open(map, marker);
	    }); 
	  
		function setupClickListener(id, types) {
			var radioButton = document.getElementById(id);
			google.maps.event.addDomListener(radioButton, 'click', function() {
			  autocomplete.setTypes(types);
			});
		}

	  setupClickListener('changetype-all', []);
	  setupClickListener('changetype-establishment', ['establishment']);
	  setupClickListener('changetype-geocode', ['geocode']);
	}

	function gmaps_add(ulat, ulng) {
		
	  $("#ic_event_clocation").attr("class","form-control"); 
		
	  var latLng = new google.maps.LatLng(ulat, ulng);
	  var mapOptions = {
		center: latLng,
		zoomControl: true,
		zoom: 16, 
		mapTypeId: google.maps.MapTypeId.ROADMAP
	  };
	  var map = new google.maps.Map(document.getElementById('gmapsCanvas'),
		mapOptions);
	  
		$("#ic_event_clocation").keypress(function(e) {
			if (e.which == 13) {
				e.preventDefault();
			}
		});	
		
		var input = (document.getElementById('ic_event_clocation'));
		var autocomplete = new google.maps.places.Autocomplete(input);

		autocomplete.bindTo('bounds', map);

		var infowindow = new google.maps.InfoWindow();
		var marker = new google.maps.Marker({
			position: latLng,
			map: map,
			draggable: true
		});
	  
		google.maps.event.addListener(map, "idle", function(){
			google.maps.event.trigger(map, 'resize'); 
			map.setZoom( map.getZoom() - 1);
			map.setZoom( map.getZoom() + 1); 
		});					
	   
		google.maps.event.addListener(marker, 'dragend', function() {
			geocodePosition(marker.getPosition());
		});
		
		google.maps.event.addListener(autocomplete, 'place_changed', function() {

			infowindow.close();
			marker.setVisible(false);
			input.className = '';
			var place = autocomplete.getPlace();
			if (!place.geometry) { 
			  input.className = 'notfound';
			  return;
			}
		 
			if (place.geometry.viewport) {
			  map.fitBounds(place.geometry.viewport);
			} else {
			  map.setCenter(place.geometry.location);
			  map.setZoom(13); 
			}
			marker.setIcon(/** @type {google.maps.Icon} */({
			  url: place.icon,
			  size: new google.maps.Size(71, 71),
			  origin: new google.maps.Point(0, 0),
			  anchor: new google.maps.Point(17, 34),
			  scaledSize: new google.maps.Size(35, 35)
			}));
			marker.setPosition(place.geometry.location);
			marker.setVisible(true);
			geocodePosition(marker.getPosition());
			var address = '';
			if (place.address_components) {
			  address = [
				(place.address_components[0] && place.address_components[0].short_name || ''),
				(place.address_components[1] && place.address_components[1].short_name || ''),
				(place.address_components[2] && place.address_components[2].short_name || '')
			  ].join(' ');
			}
			
			infowindow.setContent('<b><u>' + place.name + '</u></b><br>' + address);
			infowindow.open(map, marker);
		});
	 
		function setupClickListener(id, types) {
			var radioButton = document.getElementById(id);
			google.maps.event.addDomListener(radioButton, 'click', function() {
			  autocomplete.setTypes(types);
			});
		}

	  setupClickListener('changetype-all', []);
	  setupClickListener('changetype-establishment', ['establishment']);
	  setupClickListener('changetype-geocode', ['geocode']);
	}	
  
	function getRequest(url, callback) {
		var xhr;		
		var timeoutTimer;
		
		
		if(typeof callback === "undefined"){
			try {
				xhr = new XMLHttpRequest();
			} catch( e ) {throw new Error("argument missing");}			
		}
		if (window.XMLHttpRequest || window.document || window.ActiveXObject) {
			xhr = new XMLHttpRequest(); // IE7+, Firefox, Chrome, Opera, Safari
		} 
		
		function readystatechange() {
			loadFunc()
		}
		
		function loadFunc() {
			if (xhr.readyState === 4){ 
				$('#loading').show();
				progressHandlingFunction(xhr.readyState === 4); 
				if (xhr.status === 200 || xhr.status === 304 || xhr.status === 1223) {
					//callback(xhr);
					$('#calendar').fullCalendar('refetchEvents');
				}
			}else {$('#loading').hide();} 
		}		
 
		function getBody() {
			// Chrome with requestType=blob throws errors arround when even testing access to responseText
			var body = undefined
			 
			if (xhr.response) {
				body = xhr.response
			} else if (xhr.responseType === "text" || !xhr.responseType) {
				body = xhr.responseText || xhr.responseJSON
			}
 

			if (isJson) {
				try {
					body = JSON.parse(body)
				} catch (e) {}
			}

			return body
		}

		var failureResponse = {
					body: getBody(),
					statusCode: 0,
					method: method,
					headers: {},
					url: url,
					rawRequest: xhr			 
				}

		function errorFunc(evt) {
			clearTimeout(timeoutTimer)
			if(!(evt instanceof Error)){
				evt = new Error("" + (evt || "Unknown Error") )
			} 
			evt.statusCode = 0
			callback(evt, failureResponse)
		}
 
		function parseHeaders(headerStr){
			var headers = xhr.headers;
			if (!headerStr) {
			  return headers;
			}

			var headerPairs = headerStr.split('\u000d\u000a');
			for (var i = 0; i < headerPairs.length; i++) {
			  var headerPair = headerPairs[i];
			  // Can't use split() here because it does the wrong thing
			  // if the header value has the string ": " in it.
			  var index = headerPair.indexOf('\u003a\u0020');
			  if (index > 0) {
				var key = headerPair.substring(0, index);
				var val = headerPair.substring(index, 2);
				if (xhr.setRequestHeader) {
					for(key in headers){
						if(headers.hasOwnProperty(key)){
							xhr.setRequestHeader(key, headers[key])
						}
					}
				} else {
					throw new Error("Headers cannot be set on object")
				}
			  }
			}

		return headers;
		}
		  
		// will load the data & process the response in a special response object
		function onloadFunc() {
			if (aborted) return
			var status
			clearTimeout(timeoutTimer)
			if(xhr.status===undefined) {
				//IE8 CORS GET successful response doesn't have a status field, but body is fine
				status = 200
			} else {
				status = (xhr.status === 1223 ? 204 : xhr.status)
			}
			var response = failureResponse
			var err = null

			if (status !== 0){
				response = {
					body: getBody(),
					statusCode: status,
					method: method,
					headers: {},
					url: url,
					rawRequest: xhr
				}
				if(xhr.getAllResponseHeaders){ //remember xhr can in fact be XDR for CORS in IE
				   response.headers = parseHeaders(xhr.getAllResponseHeaders())
				}
			} else {
				err = new Error("Internal Error")
			}
			callback(err, response.body)

		}
		
		var aborted;
		var method = xhr.method = "GET";
		var body = getBody();
		var headers = xhr.headers;
		var isJson = true;
		var timeout = 0;

		if (isJson) {  
			if (method !== "GET" && method !== "HEAD") {
				headers["content-type"] || headers["Content-Type"] || (headers["Content-Type"] = "application/json") || (headers["Access-Control-Allow-Methods"] = "GET") || (headers["Access-Control-Allow-Origin"] = "*") //Don't override existing accept header declared by user
				body = JSON.stringify();
			}
		}

		xhr.onreadystatechange = readystatechange
		xhr.onload = onloadFunc
		xhr.onerror = errorFunc
		// IE9 must have onprogress be set to a unique function.
		xhr.onprogress = loadFunc
		xhr.ontimeout = errorFunc
		xhr.open(method, url, true) 
		// Cannot set timeout with sync request
		// not setting timeout on the xhr object, because of old webkits etc. not handling that correctly
		// both npm's request and jquery 1.x use this kind of timeout, so this is being consistent
		if (timeout > 0 ) {
			timeoutTimer = setTimeout(function(){
				aborted=true//IE9 may still call readystatechange
				xhr.abort("timeout")
				var e = new Error("timeout")
				e.code = "ETIMEDOUT"
				errorFunc(e)
			},  timeout )
		}
 
		xhr.send(body)

		return xhr

	}
  
	
return cifc; // export for Node/CommonJS
});