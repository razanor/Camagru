(function() {
	var video = document.getElementById('video'),
		canvas = document.getElementById('canvas'),
		context = canvas.getContext('2d'),
		photo = document.getElementById('photo'),
		vendorUrl = window.URL || window.webkitURL;

	navigator.getMedia = 	navigator.getUserMedia ||
							navigator.webkitGetUserMedia ||
							navigator.mozGetUserMedia ||
							navigator.msGetUserMedia;
	navigator.getMedia({
		video: true,
		audio: false
	}, function(stream) {
		video.srcObject = stream;
		video.play();
	}, function(error) {
		// an error occured
		// error.code
	});

	document.getElementById('capture').addEventListener('click', function() {
		context.drawImage(video, 0, 0, 400, 300);
		photo.setAttribute('src', canvas.toDataURL('image/png'));
		document.getElementById("post").style.display="block";
	});

}) ();

	function ajax() {
		var data = "data=" + document.getElementById('photo').getAttribute('src');
		var xhr = new XMLHttpRequest();
		xhr.open('POST', '/save-photo/', true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.setRequestHeader("Content-lenght", data.lenght);
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				console.log(xhr.responseText);
				window.location.href = '/user-page/';
			} 
		}
		xhr.send(data); 
	}


