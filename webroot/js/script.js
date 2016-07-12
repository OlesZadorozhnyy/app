define(['https://maps.googleapis.com/maps/api/js?key=AIzaSyDGcxjhMS-kIxUVUb1NwZ3YS0z3fHZfJ-U'], function() {

	var FormModule = function() {

		var lastMarker = null;

		var icon = '/webroot/images/marker.png';

		var inputs = {
			lat: document.getElementById('lat'),
			lng: document.getElementById('lng'),
			message: document.getElementById('message'),
			currentPage: document.getElementById('postId'),
			coords: document.getElementsByClassName('coords')
		};

		var defaultCoords = {
			lat: 50.000,
			lng: 25.000,
			zoom: 6
		};

		this.init = function() {
			this.initBindinds();
			if (inputs.currentPage.value.length > 0) {
				this.getPosition();
			} else {
				this.yourLocation();
			}
		};

		this.initBindinds = function() {
			var that = this;

			document.addEventListener('change', function(event) {

				if (event.target.getElementsByClassName('coords')) {
					coords = {
						lat: Number(inputs.lat.value),
						lng: Number(inputs.lng.value)
					};
					if (that.inRange(-90, coords.lat, 90) && that.inRange(-180, coords.lng, 180)) {
						
						map = that.initMap(coords.lat, coords.lng);

						that.addMarker(coords, map);
						that.newCoords(map);
					} else {
						alert('Incorrect coordinates :(');
					}
				}
			});

			that.newCoords(that.initMap());
		};

		this.initMap = function(lat, lng, zoom) {

			if (!lat) {
				lat = defaultCoords.lat;
			}
			if (!lng) {
				lng = defaultCoords.lng;
			}
				
			if (!zoom) {
				zoom = defaultCoords.zoom;
			}	

			return new google.maps.Map(document.getElementById('map'), {
				center: {lat: lat, lng: lng},
				zoom: zoom
			});
		};

		this.addMarker = function(pos, map) {
			var marker = new google.maps.Marker({map: map, position: pos, icon: icon});
			lastMarker = marker;
		};

		this.yourLocation = function() {
			var that = this;

			var map = that.initMap();

			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
					var pos = {
						lat: position.coords.latitude,
						lng: position.coords.longitude
					};

					map = that.initMap(pos.lat, pos.lng);

					that.addMarker(pos, map);

					inputs.lng.value = pos.lng;
					inputs.lat.value = pos.lat;
				}, function(error) {
					if (error.code == error.PERMISSION_DENIED) {
						inputs.message.innerHTML = 'Click on map to define position';
						that.newCoords(map);
					}
				});
			} else {
				inputs.message.innerHTML = 'Your browser doesn\'t support geolocation';
			}
		};

		this.getPosition = function() {
			var that = this;

			var coords = {
				lat: Number(inputs.lat.value),
				lng: Number(inputs.lng.value)
			};

			var map = that.initMap(coords.lat, coords.lng);

			that.addMarker(coords, map);

			that.newCoords(map);	
		};

		this.newCoords = function(map) {
			var that = this;

			google.maps.event.addListener(map, 'click', function(event) {
				if (lastMarker) {
					lastMarker.setMap(null);
				}

				that.addMarker(event.latLng, map);

				inputs.lng.value = event.latLng.lng();
				inputs.lat.value = event.latLng.lat();
			});
		};

		this.inRange = function(min, number, max) {
			if (!isNaN(number) && (number >= min) && (number <= max)) {
				return true;
			} else {
				return false;
			}
		};
	    
		return this.init();
	}

	return FormModule();
});