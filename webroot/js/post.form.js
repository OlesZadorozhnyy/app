define(['https://maps.googleapis.com/maps/api/js?key=AIzaSyDGcxjhMS-kIxUVUb1NwZ3YS0z3fHZfJ-U'], function() {

	var FormModule = function() {

		var map = null;

		var lastMarker = null;

		var icon = '/webroot/images/marker.png';

		var elements = {
			lat: document.getElementById('lat'),
			lng: document.getElementById('lng'),
			message: document.getElementById('message'),
			postId: document.getElementById('postId'),
			coords: document.getElementsByClassName('coords'),
			map: document.getElementById('map')
		};

		var defaultCoords = {
			lat: 50.000,
			lng: 25.000,
			zoom: 6
		};

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

		var errorBlocks = { 'lat': null, 'lng': null };

		this.init = function() {
			map = this.initMap();
			this.initBindinds();
			if (elements.postId.value.length > 0) {
				this.getPosition();
			} else {
				this.yourLocation();
			}
		};

		this.initBindinds = function() {
			var that = this;

			document.addEventListener('change', function(event) {
				if (event.target.getElementsByClassName('coords')) {

					var blockForError = document.getElementsByClassName(event.target.name+'-error')[0];
					blockForError.innerHTML = 'Incorrect coordinates :(';
					blockForError.style.display = 'none';
					
					var coords = {
						'lat': Number(elements.lat.value),
						'lng': Number(elements.lng.value)
					};

					if (that.inRange(coords.lat, 'lat') && that.inRange(coords.lng, 'lng')) {

						that.addMarker(coords);

					} else {

						if (!that.inRange(coords[event.target.name], event.target.name)) {
							blockForError.style.display = 'block';
							errorBlocks[event.target.name] = blockForError;
						} else {
							blockForError.style.display = 'none';
							errorBlocks[event.target.name] = null;					
						}

					}
				}
			});


			google.maps.event.addListener(map, 'click', function(event) {

				that.addMarker(event.latLng);

				elements.lng.value = event.latLng.lng();
				elements.lat.value = event.latLng.lat();
			});
		};

		this.initMap = function(lat, lng, zoom) {

			var lat = lat || defaultCoords.lat;
			var lng = lng || defaultCoords.lng;
			var zoom = zoom || defaultCoords.zoom;	

			return new google.maps.Map(elements.map, {
				center: {lat: lat, lng: lng},
				zoom: zoom
			});
		};

		this.addMarker = function(pos) {
			if (lastMarker) {
				lastMarker.setMap(null);
			}
			var marker = new google.maps.Marker({map: map, position: pos, icon: icon});
			map.setCenter(pos);
			lastMarker = marker;
		};

		this.yourLocation = function() {
			var that = this;

			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
					var pos = {
						lat: position.coords.latitude,
						lng: position.coords.longitude
					};

					that.addMarker(pos);

					elements.lng.value = pos.lng;
					elements.lat.value = pos.lat;
				}, function(error) {
					if (error.code == error.PERMISSION_DENIED) {
						elements.message.innerHTML = 'Click on map to define position';
					}
				});
			} else {
				elements.message.innerHTML = 'Your browser doesn\'t support geolocation';
			}
		};

		this.getPosition = function() {
			var that = this;
			var coords = {
				lat: Number(elements.lat.value),
				lng: Number(elements.lng.value)
			};

			that.addMarker(coords);
		};

		this.inRange = function(value, type) {

			if (!isNaN(value) && (value >= coordinateRules[type].min) && (value <= coordinateRules[type].max)) {
				return true;
			} else {
				return false;
			}
		};
	    
		return this.init();
	}

	return FormModule();
});