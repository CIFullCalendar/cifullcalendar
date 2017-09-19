/*!
 * CIFullCalendar v3.3.0.0
 * Docs & License: http://www.cifullcalendar.com
 * (c) 2016 Sir.Dre
 */
(function(factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        // AMD is used - Register as an anonymous module.
        define(['jquery', 'moment'], factory);
    } else if (typeof exports === 'object') {
        factory(require('jquery'), require('moment'));
    } else {
        // Neither AMD nor CommonJS used. Use global variables.	
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

	$.cifullCalendar = { version: "2.6.0" };  
 
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
	
    var date = new Date();
    var dt = date.getDate();
    var s = date.getSeconds();
    var ms = date.getMinutes();
    var h = date.getHours();
    var d = date.getDay();
    var m = date.getMonth();
    var y = date.getFullYear(); 
	 
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

	var regex = new RegExp("(.+)");
	var url = window.location.pathname.replace(regex, './admin/home/');
		
	var siteurl = window.location.pathname.replace('index.php/admin', '') 
				+ "assets/attachments/";	

 
	var eventSources = new Array();
	var filterSources = new Array();  
	
	eventSources[0] = url +'json'; 
	realtime();
	
	var aspectratio = 1.35;
	var currentDefaultview = '';
	var currentLangCode = '';
	var currentTimezoneCode = '';
	var currentTimezoneCode2 = '';
	var startdate = 'start';
	var enddate = 'end';
	var timescroll = '';
	var headerLeft = '';
	var headerCenter = '';
	var headerRight = '';
	var hiddendays = '';
	var hiddenday0 = '';
	var hiddenday1 = '';
	var hiddenday2 = '';
	var hiddenday3 = '';
	var hiddenday4 = '';
	var hiddenday5 = '';
	var hiddenday6 = '';	 
	var businesshours = false;
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
	var	mintime = '00:00:00';
	var	maxtime = '24:00:00';	  
	var slotduration = '00:30:00'; 
	var slotlabeling = false;
	var firstday = 0;	
	var weekends = true;
	var fixedweekcount = false;
	var editable1 = false;
	var weeknumbers1 = false;
	var eventlimit1 = true;
	var alldayslot = true;
	var isrtl = false;
	var nowindicator = true;
	var navlinks = true;	
	var theme1 = false;
	
	var linktoics = 'Export to ICS'; 
	
	// re-render the calendar when the selected option changes
	getRequest(url +"get_timezone", function(err, data) {			 
		if(!empty(data)){
			currentTimezoneCode = data; 
		}
	});	
	
	getRequest(url +"get_timezone2", function(err, data) {			 
		if(!empty(data)){
			currentTimezoneCode2 = data;
			timescroll = moment.tz(currentTimezoneCode2).format(time24format); 
		}
	});
	
	getRequest(url +"get_defaultview", function(err, data) {			 
		if(!empty(data)){
			currentDefaultview = data;
		}
	});	
	
	getRequest(url +"get_header_left", function(err, data) {			 
		if(!empty(data)){
			headerLeft = data;
		}
	});	
	
	getRequest(url +"get_header_center", function(err, data) {			 
		if(!empty(data)){
			headerCenter = data;
		}
	});	
	
	getRequest(url +"get_header_right", function(err, data){			 
		if(!empty(data)){
			headerRight = data;	 
		}
	});	
	
	getRequest(url +"get_firstday", function(err, data) {			 
		if(!empty(data)){
			firstday = data; 
		}
	});
	
	getRequest(url +"get_mintime", function(err, data) { 
		if(!empty(data)){
			mintime = data; 
		}
	});	
	
	getRequest(url +"get_maxtime", function(err, data) { 
		if(!empty(data)){
			maxtime = data; 
		}
	});	 
	
	getRequest(url +"get_slotduration", function(err, data) { 
		if(!empty(data)){
			slotduration = data; 
		}		
	});	
	
	getRequest(url +"get_slotlabeling", function(err, data) { 
		if(!empty(data)){
			(data == "true") ? slotlabeling = true : slotlabeling = false; 
		} 
	});	
	
	getRequest(url +"get_slotlabelformat", function(err, data) {	 
		if(!empty(data)){
			slotformat = data; 
		} 
	});
	
	getRequest(url +"get_aspectratio", function(err, data) { 
		if(!empty(data)){
			(data != aspectratio ) ? aspectratio = data : aspectratio = aspectratio; 
		}
	});	
	
	getRequest(url +"get_hiddendays", function(err, data) {	 
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

	
	getRequest(url +"get_businessstart", function(err, data) {			 
		if(!empty(data)){
			businessStart = data;	
		}			
	});	
	
	getRequest(url +"get_businessend", function(err, data) {			 
		if(!empty(data)){businessEnd = data; } 
	});	
	
	getRequest(url +"get_businessdays", function(err, data) { 
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
	
	getRequest(url +"get_weeknumbers", function(err, data) {	 
		(data == "true") ? weeknumbers1 = true : weeknumbers1 = false; 
	});	
	
	getRequest(url +"get_eventlimit", function(err, data) {		 
		(data == "true") ? eventlimit1 = true : eventlimit1 = false; 
	});	
		
	getRequest(url +"get_alldayslot", function(err, data) {		 
		(data == "true") ? alldayslot = true : alldayslot = false; 
	});	
	
	getRequest(url +"get_isrtl", function(err, data) {			 
		(data == "true") ? isrtl = true : isrtl = false; 
	});		
	
			
	getRequest(url +"get_lang", function(err, data) {	 
		currentLangCode = data;
		moment.defineLocale(currentLangCode, {
		  parentLocale: currentLangCode, 
		});
		lang = $.extend(cifc.DEFAULTS, cifc.LOCALES[currentLangCode]);
		timedUpdate();
		
		$('#calendar').fullCalendar({
			
			defaultView: currentDefaultview, 
			locale: currentLangCode,
			minTime: ''+mintime+'',
			maxTime: ''+maxtime+'', 				
			aspectRatio: aspectratio,
						
			defaultDate: date,
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
			theme: theme1, 
			navLinks: navlinks, // can click day/week names to navigate views
			
			allDaySlot: alldayslot, 
			
			fixedWeekCount: fixedweekcount,
			firstDay: firstday,		
			weekends: weekends,
			weekNumbers: weeknumbers1, 
			hiddenDays: [hiddenday0,hiddenday1,hiddenday2,hiddenday3,hiddenday4,hiddenday5,hiddenday6],
			businessHours: {
				start: businessStart, // a start time (10am in this example)
				end: businessEnd, // an end time (6pm in this example) 
				dow: [businessdays0, businessdays1, businessdays2, businessdays3, businessdays4,businessdays5,businessdays6 ]
				// days of week. an array of zero-based day of week integers (0=Sunday)
				// (Monday-Thursday in this example)
			}, // display business hours			
			
			editable: editable1,
			eventStartEditable: editable1,
			eventDurationEditable: editable1, 		
			
			selectable: editable1, 		
			selectHelper: editable1,			
			
			eventLimit: eventlimit1, 

			startParam: startdate,
			endParam: enddate, 		
			
			eventSources: [eventSources[0]],
			 
			eventRender: function(event, element, view) {
				var limit = 14;
				if (event.title.length > limit) {
					element.find('.fc-title').text(event.title.substr(0,limit)+'...').parent().attr('title', event.title);
				}
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
			
			eventClick: function(event, jsEvent, view)  { 
  
				var starttime = (event.start) ? $.fullCalendar.moment(event.start).format(datetimeformat) : $.fullCalendar.moment(date).format(datetimeformat);
				var endtime   = (event.end) ? $.fullCalendar.moment(event.end).format(datetimeformat) : $.fullCalendar.moment(event.start).format(datetimeformat);
				var today   = $.fullCalendar.moment(starttime).format(dateformat);
				var etoday   = $.fullCalendar.moment(endtime).format(dateformat);
				var showend = (today < etoday) ? $.fullCalendar.moment(endtime).format(datetimeaformat) : $.fullCalendar.moment(endtime).format(timeaformat);
				
				var mywhen = $.fullCalendar.moment(starttime).format(datetimeaformat) + " - " + showend;  	 
				 
				var currentend = (event.end) ? $.fullCalendar.moment(event.end).format(datetimetzformat) : $.fullCalendar.moment(event.start).format(datetimetzformat); 		
				
				var minsDuration = ( endtime - starttime ) / 60 / 1000;
				var durationString = ((minsDuration / 60) + (minsDuration%60)).toString();
				
				var ulat = parseFloat(event.latitude).toFixed(14); 
				var ulng = parseFloat(event.longitude).toFixed(14); 

				gmaps_public(ulat, ulng, event.location); 				
				 
				$('#viewEventModal #gexport').html('<a href="//www.google.com/calendar/event?action=TEMPLATE&amp;text='+ event.title +
				'&amp;dates='+ $.fullCalendar.moment(starttime).format(datetimetzformat) +
				'/'+ currentend +
				'&amp;details='+ event.description +
				'&amp;location='+ event.location +
				'&amp;sprop=website:" title="Google" target="_blank" ><i class="fa fa-google"></i></a>');

				$('#viewEventModal #yexport').html("<a href='//calendar.yahoo.com/?v=60" +
				"&DUR=" + durationString.substr(0,2) +
				"&TITLE=" + event.title +
				"&ST=" + $.fullCalendar.moment(starttime).format(datetimetzformat) +
				"&in_loc=" + event.location +
				"&DESC=" + event.description +
				"&URL=" + event.url + "' title='Yahoo' target='_blank' ><i class='fa fa-yahoo'></i></a>" );

				$('#viewEventModal #lexport').html("<a href='//calendar.live.com/calendar/calendar.aspx?rru=addevent" +
				"&dtstart=" + starttime +
				"&dtend=" + endtime +
				"&summary=" + event.title +
				"&description=" + event.description +
				"&location=" + event.location + "' title='Microsoft' target='_blank' ><i class='fa fa-windows'></i></a>" );							 
				
				$('#viewEventModal #Iexport').html("<a href='"+ url +"export/" +
				"" + event.id + "' title='"+ linktoics +"' ><i class='fa fa-calendar-o'></i></a>"	); 
				
				$('#viewEventModal #ic_event_title').text(event.title); 
				$('#viewEventModal #ic_event_desc').text(event.description);
				$('#viewEventModal #ic_event_urllink').text(event.url);
				$('#viewEventModal #ic_event_location').text(event.location);  
				$('#viewEventModal #markers_ulng').text(ulng); 
				$('#viewEventModal #markers_ulat').text(ulat);   
				$('#viewEventModal #ic_event_allday').text(event.allDay);  
				$('#viewEventModal #ic_event_author').text(event.username);  
				$('#viewEventModal #filename').html('<a href="' + siteurl 
				+ '' + event.filename 
				+ '" title="' + event.filename 
				+ '" target="_blank"><b>' + event.filename + '</b></a>');	 
				$('#viewEventModal #when').text(mywhen);   
				$('#viewEventModal').modal('show'); 
			
			}, 
			
			eventMouseover: function( event, jsEvent, view ) { 
		 
			   $('.fc-content').popover({
					trigger: 'hover',
					html: true, 
					
					title: function() {
					  return $(this).parent().find('.fc-title').html();  
					},
					content: function() {
					  return $(this).parent().find('.fc-description').html();
					},				
					container: 'body',
					placement: 'top'

				  });		
			}, 		
			
			loading: function(bool) {
				if (bool) {
					$('#loading').show();
					progressHandlingFunction(bool);
				}else{ $('#loading').hide();}
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
	
    $("#title").off('keyup drop').on('keyup drop', function (event) {
		var timeoutId = 0;
		clearTimeout(timeoutId); // doesn't matter if it's 0
		timeoutId = setTimeout(function () {
			event.preventDefault();	
			var value = $("#title").val(); 
			
			if(empty(value)) { 
				filterSources[0] = url +'json'; 
				$('#calendar').fullCalendar('removeEventSource', eventSources[0]); 
				$('#calendar').fullCalendar('refetchEvents');
				$('#calendar').fullCalendar('addEventSource', filterSources[0]); 
				$('#calendar').fullCalendar('refetchEvents'); 
				eventSources[0] = filterSources[0];  
			}else{ 
				filterSources[0] = url +'search?title='+value; 
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
			filterSources[0] = url +'json'; 
			$('#calendar').fullCalendar('removeEventSource', eventSources[0]); 
			$('#calendar').fullCalendar('refetchEvents');
			$('#calendar').fullCalendar('addEventSource', filterSources[0]); 
			$('#calendar').fullCalendar('refetchEvents'); 
			eventSources[0] = filterSources[0];  
		}else{ 
			filterSources[0] = url +'search?title='+value; 
			$('#calendar').fullCalendar('removeEventSource', eventSources[0]); 
			$('#calendar').fullCalendar('refetchEvents');
			$('#calendar').fullCalendar('addEventSource', filterSources[0]); 
			$('#calendar').fullCalendar('refetchEvents'); 
			eventSources[0] = filterSources[0]; 
		}
	});	 
	
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

    function realtime () {  
		$('#calendar').fullCalendar('refetchEvents');  
		setTimeout(realtime, 60000);
    }
	
    function timedUpdate () {
        updateClock();
        updateSnippets();
        setTimeout(timedUpdate, 1000);
    }
	
	function empty(v) { 
		var t = typeof v; 
		return t === 'undefined' || ( t === 'object' ? ( v === null || Object.keys( v ).length === 0 ) : [false, 0, "", "0"].indexOf( v ) >= 0 ); 
	};
	
	function is_string(v) { 
	  return (typeof v === 'string');
	}

 
	function gmaps_public(ulat, ulng, address) { 
		
		var latLng = new google.maps.LatLng(ulat, ulng);
		if(!empty(address)){
			
			$("#gmapsCanvas").attr("class","map"); 
			$("#markers_ulat").attr("class","map"); 
			$("#markers_ulng").attr("class","map"); 
			
			var mapOptions = {
			center: latLng,
			zoomControl: true,
			zoom: 19,	
			mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var map = new google.maps.Map(document.getElementById('gmapsCanvas'),
			mapOptions); 
			
			var infowindow = new google.maps.InfoWindow();
			var marker = new google.maps.Marker({
			position: latLng,
			map: map,
			draggable: false
			});

			google.maps.event.addListener(map, "idle", function(){
			google.maps.event.trigger(map, 'resize'); 
			 map.setZoom( map.getZoom() - 1);
			 map.setZoom( map.getZoom() + 1);
			});	 
			
			google.maps.event.addListenerOnce(map,'center_changed', function() {
				window.setTimeout(function() {
				map.panTo(marker.getPosition());
				}, 500);
			});	
			
		}else{
			$("#gmapsCanvas").attr("class","mapHidden"); 
			$("#markers_ulat").attr("class","mapHidden"); 
			$("#markers_ulng").attr("class","mapHidden"); 
		}
	}	
	
	function progressHandlingFunction(e){
		if(e.lengthComputable){
			$('progress').attr({value:e.loaded,max:e.total});
		}
	} 
	
	function getRequest(url, callback) {
		var xhr;
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
				body = xhr.responseText || xhr.responseXML
			}
 

			if (isJson) {
				try {
					body = JSON.parse(body)
				} catch (e) {}
			}

			return body
		}

		var failureResponse = {
					body: undefined,
					headers: {},
					statusCode: 0,
					method: method,
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
		
		var aborted 
		var method = xhr.method = "GET"
		var body = getBody()
		var headers = xhr.headers 
		var isJson = true
		var timeoutTimer
		var timeout = 0

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