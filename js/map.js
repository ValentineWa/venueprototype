/* script */
function initialize() {
   var latlng = new google.maps.LatLng(-1.286389,36.817223);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: true,
      anchorPoint: new google.maps.Point(0, -29)
   });
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();   
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
       
        marker.setPosition(place.geometry.location);
        marker.setVisible(true); 
						var address = "";
						if (place.address_components) {
							address = [
									(place.address_components[0]
											&& place.address_components[0].short_name || ""),
									(place.address_components[1]
											&& place.address_components[1].short_name || ""),
									(place.address_components[2]
											&& place.address_components[2].short_name || "") ]
									.join(" ");

							placeParser = function(place) {
								result = {};
								for (var i = 0; i < place.address_components.length; i++) {
									ac = place.address_components[i];
									result[ac.types[0]] = ac.long_name;
								}
								return result;
							};

							parsed = placeParser(place);
							

							//var postcode = parsed.postal_code;
							var vicinity = place.vicinity;
							var street = parsed.route;
							var locality = parsed.locality;
							var postal_code = parsed.postal_code;
							var country = parsed.country;
							var country_region = [
									(parsed.administrative_area_level_5 && parsed.administrative_area_level_5),
									(parsed.administrative_area_level_4 && parsed.administrative_area_level_4),
									(parsed.administrative_area_level_3 && parsed.administrative_area_level_3),
									(parsed.administrative_area_level_2 && parsed.administrative_area_level_2),
									(parsed.administrative_area_level_1 && parsed.administrative_area_level_1) ]
									.filter(Boolean).join(",");

							$("input.country").val(country);
							$("input.country-region").val(country_region);
							$("input.street").val(street);
							$("input.locality").val(locality);
							$("input.postal-code").val(postal_code);
							$("input.vicinity").val(vicinity);

						}
    
        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);
       
    });
    // this function will work on marker move event into map 
    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {
	
	        var place = results[0];
	
							var address = "";
						if (place.address_components) {
							address = [
									(place.address_components[0]
											&& place.address_components[0].short_name || ""),
									(place.address_components[1]
											&& place.address_components[1].short_name || ""),
									(place.address_components[2]
											&& place.address_components[2].short_name || "") ]
									.join(" ");

							placeParser = function(place) {
								result = {};
								for (var i = 0; i < place.address_components.length; i++) {
									ac = place.address_components[i];
									result[ac.types[0]] = ac.long_name;
								}
								return result;
							};

							parsed = placeParser(place);

							//var postcode = parsed.postal_code;
							var vicinity = place.vicinity;
							var street = parsed.route;
							var locality = parsed.locality;
							var postal_code = parsed.postal_code;
							var country = parsed.country;
							var country_region = [
									(parsed.administrative_area_level_5 && parsed.administrative_area_level_5),
									(parsed.administrative_area_level_4 && parsed.administrative_area_level_4),
									(parsed.administrative_area_level_3 && parsed.administrative_area_level_3),
									(parsed.administrative_area_level_2 && parsed.administrative_area_level_2),
									(parsed.administrative_area_level_1 && parsed.administrative_area_level_1) ]
									.filter(Boolean).join(",");

							$("input.country").val(country);
							$("input.country-region").val(country_region);
							$("input.street").val(street);
							$("input.locality").val(locality);
							$("input.postal-code").val(postal_code);
							$("input.vicinity").val(vicinity);


						}
             bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
          }
        }
        });
    });
}
function bindDataToForm(fullAddress,latitude,longitude){
   document.getElementById('address').value = fullAddress;
   document.getElementById('latitude').value = latitude;
   document.getElementById('longitude').value = longitude;
}
google.maps.event.addDomListener(window, 'load', initialize);