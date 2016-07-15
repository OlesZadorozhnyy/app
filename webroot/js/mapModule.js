define(['gmaps'], function() {

	var map = null;

	var lastMarker = null;

	var icon = '/webroot/images/marker.png';

	var defaultCoords = {
		lat: 50.000,
		lng: 25.000,
		zoom: 6
	};

	var elements = {
		map: document.getElementById('map')
	}

	var coordinateRules = { 
		'lat': {
			min: -90,
			max: 90
		},

		'lng': {
			min: -180,
			max: 180
		}
	};


	return {

		initMap: function(lat, lng, zoom) {
			var lat = lat || defaultCoords.lat;
			var lng = lng || defaultCoords.lng;
			var zoom = zoom || defaultCoords.zoom;	

			return map = new google.maps.Map(elements.map, {
				center: {lat: lat, lng: lng},
				zoom: zoom
			});
		},

		addMarker: function(pos, list, content) {
			var that = this;
			var marker = new google.maps.Marker({map: map, position: pos, icon: icon});
			
			if (!list) {
				if (lastMarker) {
					lastMarker.setMap(null);
				}
				map.setCenter(pos);
				lastMarker = marker;
			} else {
				var infoWindow = new google.maps.InfoWindow({
					content: content
				});

				marker.addListener('click', function() {
    				infoWindow.open(that.map, marker);
  				});
			}
			
		},

		inRange: function(value, type) {

			if (!isNaN(value) && (value >= coordinateRules[type].min) && (value <= coordinateRules[type].max)) {
				return true;
			} else {
				return false;
			}
		}

	}
});