/*!
 * CIFullCalendar v2.6.0
 * Docs & License: http://sirdre.com/apps/cifullcalendar/docs/
 * (c) 2015 sirdre
 */
(function(factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        // AMD is used - Register as an anonymous module.
        define(['jquery', 'MarkerClusterer'], factory);
    } else if (typeof exports === 'object') {
        factory(require('jquery'), require('google.maps.Geocoder'));
    } else {
        // Neither AMD nor CommonJS used. Use global variables.
        if (typeof google.maps.Geocoder === 'undefined') {
            throw 'CIFullCalendar requires Gmaps to be loaded first';
        }       	
		if (typeof MarkerClusterer === 'undefined') {
            throw 'CIFullCalendar requires MarkerClusterer to be loaded first';
        }        
		if (typeof jQuery === 'undefined') {
            throw 'CIFullCalendar requires jQuery to be loaded first';
        } 
        factory(jQuery, MarkerClusterer);
    }
})(function($, MarkerClusterer) {

;;

var map;
var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();
var bounds = new google.maps.LatLngBounds();
var markers = [];
var category;

var base_regex = new RegExp("index.php/admin|admin|admin/");
var base_url = window.location.protocol + "//" 
				+ window.location.host + "/" 
				+ window.location.pathname.replace(base_regex, '') 
				+ "assets/img/pin/";
				
var base_url2 = window.location.protocol + "//" 
				+ window.location.host
				+ window.location.pathname.replace('admin/maplist', '')
				+ "/maplist";
				
get_markers();

$("#marker_category").change(function(){ 
	var e=$("#marker_category option:selected").val();	
	get_markers(e);
	
});

getMarkers("admin/home/get_category",function(i,e){
	if(!empty(e)){
		for(var a=0;a<e.length;a++)$("#marker_category").append("<option value="+e[a].category_id+">"+e[a].category_name+" ("+e[a].count+")</option>")
	}
});

function get_markers(category) {
	
	var mapOptions = { 
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
 
    map = new google.maps.Map(document.getElementById("gmapsCanvas2"), mapOptions);  
    var url = "admin/home/get_marker?category="+category;
	
	var marker = [];
	var markers = [];  
	var location = '';

    getMarkers(url, function(err, data) {	
          
        if(!empty(data)){
			for (var i = 0; i < data.length; ++i) {  
				location = data[i];  
				var position = new google.maps.LatLng(parseFloat(location.markers_lat), parseFloat(location.markers_lng));
				marker = new google.maps.Marker({
					map: map,
					icon: base_url + '' + location.markers_logo,
					position: position,
					title: location.markers_name
				}); 
					
				bounds.extend(marker.position); 
				
				marker.addListener('click', (function(marker, i) {
					return function() {
						infowindow.setContent('<h4><a href="'+ data[i].markers_url +'" target="_blank">'  + data[i].markers_name + '</a></h4>'
						+ '<p>'+ data[i].markers_desc +'</p>' 
						+ '<p><b>'+data[i].markers_address +'</b>'				
						+ '<br/><i>'+data[i].markers_lat +' , '+data[i].markers_lng +' </i></p>'				
						+ '<p><b>'+data[i].username +'</b></p>');
						infowindow.open(map, this);
					}
				})(marker, i));
				
				markers.push(marker);

			}

			var markerCluster = new MarkerClusterer(map, markers);	 
		}
				
		
		map.fitBounds(bounds);
		map.panToBounds(bounds);
    });
 
     var styleOptions = {
            name: "gStyle"
        };  
        var MAP_STYLE = [
        {
            featureType: "road",
            elementType: "all",
            stylers: [
                { visibility: "on" }
            ]
        }
    ];
		
	var mapType = new google.maps.StyledMapType(MAP_STYLE, styleOptions);
        map.mapTypes.set("gStyle", mapType);
        map.setMapTypeId("gStyle");

}
   
function empty(v) { 
	var t = typeof v; 
	return t === 'undefined' || ( t === 'object' ? ( v === null || Object.keys( v ).length === 0 ) : [false, 0, "", "0"].indexOf( v ) >= 0 ); 
};

function progressHandlingFunction(e){
	if(e.lengthComputable){
		$('progress').attr({value:e.loaded,max:e.total});
	}
} 
 
function getMarkers(url, callback) {
	var xhr;		
	var isJson = true;
	
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
				callback(xhr); 
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

});