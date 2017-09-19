/*!
 * CIFullCalendar v2.6.0
 * Docs & License: http://www.cifullcalendar.com/docs/
 * (c) 2015 sirdre
 */

var geocoder = new google.maps.Geocoder();

function geocodePosition2(pos) {
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
	$("#markers_address").val(address);  
	$("#markers_address").attr("class","form-control");
	$("#show_lat").html(lat); 
	$("#show_lng").html(lng);
	$("#markers_lat").val(lat);
	$("#markers_lng").val(lng); 
} 
											
var base_url = window.location.protocol + "//" 
				+ window.location.host + "/" 
				+ window.location.pathname.replace('index.php/profile/gmaps', '') 
				+ "assets/img/pin/";
				
var base_url2 = window.location.protocol + "//" 
				+ window.location.host
				+ window.location.pathname.replace('profile/gmaps', '')
				+ "profile";
				
													
function gmaps_update(ulat, ulng, element, element2) { 
    
	$("#markers_address").attr("class","form-control");
	
	var latLng = new google.maps.LatLng(ulat, ulng);

	var mapOptions = {
	center: latLng,
	zoom: 16,	
	mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById(element),
	mapOptions);
 
	$(element2).keypress(function(e) {
		if (e.which == 5) {
			e.preventDefault();
		}
	});	

	var uinput = (document.getElementById(element2));
	var autocomplete = new google.maps.places.Autocomplete(uinput);

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
			
	google.maps.event.addListenerOnce(map,'center_changed', function() {
		window.setTimeout(function() {
		  map.panTo(marker.getPosition());
		}, 500);
	});
		
   google.maps.event.addListener(marker, 'dragend', function() {
	  var pos = marker.getPosition();
	  geocodePosition2(pos);  
	  
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
	var address = '';
	var pos2 = marker.getPosition();
 
    geocodePosition2(pos2);  
	
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }
	
    infowindow.setContent('<div><strong><u>' + place.name + '</u></strong><br>' + address);
    infowindow.open(map, marker);
  }); 
 
}
