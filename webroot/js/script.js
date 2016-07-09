define(['jquery', 'gmaps'], function() {


	var markers = [];
	var icon = '/webroot/images/marker.png';

	return {
		initMap: function(lat, lng, zoom) {

			if (!lat) {
				lat = 50.000;
			}
			if (!lng) {
				lng = 25.000;
			}
				
			if (!zoom) {
				zoom = 6;
			}	

			return new google.maps.Map(document.getElementById('map'), {
				center: {lat: lat, lng: lng},
				zoom: zoom
			});
		},

		addMarker: function(pos, message, map) {

			var infoWindow = new google.maps.InfoWindow();
			infoWindow.setPosition(pos);
			infoWindow.setContent(message);

			var marker = new google.maps.Marker({map: map, position: pos, icon: icon});
        	marker.addListener('click', function() {
				infoWindow.open(map, marker);
			});

			markers.push(marker);
		},

		yourLocation: function() {
			var that = this;

			var map = that.initMap();

			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
					var pos = {
						lat: position.coords.latitude,
						lng: position.coords.longitude
					};

					map = that.initMap(pos.lat, pos.lng);

					that.addMarker(pos, 'Location found', map);

					$('#lng').val(pos.lng);
					$('#lat').val(pos.lat);
				}, function(error) {
					if (error.code == error.PERMISSION_DENIED) {
						$('.message').html('Click on map to define position');
						that.newCoords('', map);
					}
				});
			} else {
				$('.message').html('Your browser doesn\'t support geolocation');
			}
		},

		getPosition: function() {
			var that = this;

			var coords = {
				lat: Number($('#lat').val()),
				lng: Number($('#lng').val())
			};

			var map = that.initMap(coords.lat, coords.lng);

			that.addMarker(coords, $('#title').val(), map);

			$('#lat, #lng').change(function() {
				coords = {
					lat: Number($('#lat').val()),
					lng: Number($('#lng').val())
				};
				map = that.initMap(coords.lat, coords.lng);

				that.addMarker(coords, $('#title').val(), map);

				that.newCoords($('#title').val(), map);
			});

				that.newCoords($('#title').val(), map);	
		},

		newCoords: function(message, map) {
			var that = this;

			google.maps.event.addListener(map, 'click', function(event) {

				for (var i = 0; i < markers.length; i++) {
					markers[i].setMap(null);
				}
				that.addMarker(event.latLng, message, map);
				$('#lng').val(event.latLng.lng);
				$('#lat').val(event.latLng.lat);
			});
		}
	}
});