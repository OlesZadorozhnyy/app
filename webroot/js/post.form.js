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
			this.initMap();
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
					coords = {
						'lat': Number(elements.lat.value),
						'lng': Number(elements.lng.value)
					};

					var rules = coordinateRules[event.target.name];

					if (that.inRange(coordinateRules['lat'].min, coords.lat, coordinateRules['lat'].max) && that.inRange(coordinateRules['lng'].min, coords.lng, coordinateRules['lng'].max)) {
						map.setCenter(coords);

						if (lastMarker) {
							lastMarker.setMap(null);
						}

						if (errorBlocks[event.target.name]) {
							document.getElementsByClassName(event.target.name)[0].removeChild(errorBlocks[event.target.name]);

							errorBlocks[event.target.name] = null;
						}

						that.addMarker(coords);
						that.newCoords();
					} else if (!that.inRange(rules.min, coords[event.target.name], rules.max)) {

						if (!errorBlocks[event.target.name]) {
							var blockForError = document.createElement('div');
							blockForError.innerHTML = 'Incorrect coordinates :(';
							blockForError.className = 'error';

							var parentBlock = document.getElementsByClassName(event.target.name)[0];

							parentBlock.insertBefore(blockForError, parentBlock.firstChild);

							errorBlocks[event.target.name] = blockForError;
						}
					} else if(that.inRange(rules.min, coords[event.target.name], rules.max)) {

						if (errorBlocks[event.target.name]) {
							document.getElementsByClassName(event.target.name)[0].removeChild(errorBlocks[event.target.name]);
							errorBlocks[event.target.name] = null;
						}
					}
				}
			});

			that.newCoords();
		};

		this.initMap = function(lat, lng, zoom) {

			var lat = lat || defaultCoords.lat;

			var lng = lng || defaultCoords.lng;

			var zoom = zoom || defaultCoords.zoom;	

			return map = new google.maps.Map(elements.map, {
				center: {lat: lat, lng: lng},
				zoom: zoom
			});
		};

		this.addMarker = function(pos) {
			var marker = new google.maps.Marker({map: map, position: pos, icon: icon});
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

					map.setCenter(pos);
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

			map.setCenter(coords);

			that.addMarker(coords);

			that.newCoords();	
		};

		this.newCoords = function() {
			var that = this;

			google.maps.event.addListener(map, 'click', function(event) {
				if (lastMarker) {
					lastMarker.setMap(null);
				}

				that.addMarker(event.latLng);

				elements.lng.value = event.latLng.lng();
				elements.lat.value = event.latLng.lat();
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