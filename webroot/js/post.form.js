define(['gmaps', 'mapModule'], function(gmaps, mapModule) {

	var FormModule = function() {

		var map = null;

		var elements = {
			lat: document.getElementById('lat'),
			lng: document.getElementById('lng'),
			message: document.getElementById('message'),
			postId: document.getElementById('postId'),
			coords: document.getElementsByClassName('coords')
		};

		var errorBlocks = { 'lat': null, 'lng': null };

		this.init = function() {
			map = mapModule.initMap();
			this.initBindinds();
			if (elements.postId.value.length > 0) {
				var coords = { lat: Number(elements.lat.value), lng: Number(elements.lng.value) };
				mapModule.addMarker(coords);
			} else {
				this.yourLocation();
			}
		};

		this.initBindinds = function() {

			document.addEventListener('change', function(event) {
				if (event.target.getElementsByClassName('coords')) {

					var blockForError = document.getElementsByClassName(event.target.name+'-error')[0];
					blockForError.innerHTML = 'Incorrect coordinates :(';
					blockForError.style.display = 'none';
					
					var coords = {
						'lat': Number(elements.lat.value),
						'lng': Number(elements.lng.value)
					};

					if (mapModule.inRange(coords.lat, 'lat') && mapModule.inRange(coords.lng, 'lng')) {

						mapModule.addMarker(coords);

					} else {

						if (!mapModule.inRange(coords[event.target.name], event.target.name)) {
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

				mapModule.addMarker(event.latLng);

				elements.lng.value = event.latLng.lng();
				elements.lat.value = event.latLng.lat();
			});
		};

		this.yourLocation = function() {

			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
					var pos = {
						lat: position.coords.latitude,
						lng: position.coords.longitude
					};

					mapModule.addMarker(pos);

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
	    
		return this.init();
	}

	return FormModule();
});