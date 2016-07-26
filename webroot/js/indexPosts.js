require(['config'], function() {

	require(['gmaps', 'mapModule', 'libs/mustache'], function(gmaps, mapModule, mustache) {

		var PostsModule = function() {

			var map = null;

			var errorMessage = document.getElementById('message-row');

			var templateHTML = document.getElementById('infoWindowPostTemplate').innerHTML;

			this.init = function() {
				map = mapModule.initMap();
				this.parsePosts();
			};

			this.parsePosts = function() {
				var that = this;
				this.ajax('GET', '/api/posts', function(data, code) {
					var data = JSON.parse(data);
					var bounds = mapModule.setBounds();
					for (var i = 0; i < Object.keys(data.posts).length; i++) {

						var coords = { lat: Number(data.posts[i].lat), lng: Number(data.posts[i].lng) };
						var view = { title: data.posts[i].title, body: data.posts[i].body, user: data.posts[i].username };
						
						mapModule.addMarker(coords, true, mustache.render(templateHTML, view));
						
						bounds.extend(new google.maps.LatLng(coords));
						map.fitBounds(bounds);
					}
					
				}, function(code) {

					errorMessage.innerHTML = 'Error!';
				});
						
			};

			this.ajax = function(type, url, success, error) {
				var xhr = new XMLHttpRequest;
				xhr.onreadystatechange = function() {
					if (xhr.readyState !== 4) return;

					if (xhr.status == 200) {
						success(xhr.responseText);			
					} else {
						error(xhr.status);
					}
				};

				xhr.open(type, url, true);
				xhr.send();

			};

			return this.init();
		};

		return PostsModule();

	});
});
