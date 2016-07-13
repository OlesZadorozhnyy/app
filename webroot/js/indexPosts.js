define(['gmaps', 'mapModule'], function(gmaps, mapModule) {


	var PostsModule = function() {

		var map = null;

		this.init = function() {
			map = mapModule.initMap(null, null, 4);
			this.parsePosts();
		};

		this.initBindings = function() {

		};

		this.parsePosts = function() {
			var xhr = new XMLHttpRequest();

			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					var posts = JSON.parse(xhr.responseText);
					for (var i = 0; i < Object.keys(posts.data).length; i++) {
						var coords = { lat: Number(posts.data[i].lat), lng: Number(posts.data[i].lng) };
						console.log(coords);
						mapModule.addMarker(coords, true);
					}
				}
			};

			xhr.open('GET', '/api/posts', true);
			xhr.send();
		};

		return this.init();
	}

	return PostsModule();

});