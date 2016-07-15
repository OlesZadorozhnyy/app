define(['gmaps', 'mapModule', 'libs/mustache'], function(gmaps, mapModule, mustache) {


	var PostsModule = function() {

		var map = null;

		var template = '/templates/layouts/infoWindowTemplate.html';

		var templateHTML = null;

		this.init = function() {
			this.loadTemplate();
			map = mapModule.initMap(null, null, 4);
			this.parsePosts();
		};

		this.initBindings = function() {

		};

		this.parsePosts = function() {
			var that = this;
			this.ajax('GET', '/api/posts', function(data) {
				var posts = JSON.parse(data);
				for (var i = 0; i < Object.keys(posts.data).length; i++) {
					var coords = { lat: Number(posts.data[i].lat), lng: Number(posts.data[i].lng) };
					var view = { title: posts.data[i].title, body: posts.data[i].body };
					mapModule.addMarker(coords, true, mustache.render(that.templateHTML, view));
				}
			});
					
		};

		this.loadTemplate = function() {
			var that = this;
			this.ajax('GET', template, function(html) {
				that.templateHTML = html;
			});
		};

		this.ajax = function(type, url, callback) {
			var xhr = new XMLHttpRequest;
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					callback(xhr.responseText);			
				}
			};

			xhr.open(type, url, true);
			xhr.send();

		};


		return this.init();
	};

	

	return PostsModule();

});