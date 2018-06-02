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

	document.getElementById('photo-list').addEventListener('submit', function(event) {
		event.preventDefault();
		context.drawImage(video, 0, 0, 400, 300);
		photo.setAttribute('src', canvas.toDataURL('image/png'));
		document.getElementById("absol").style.visibility = "visible";
		document.getElementById("super").setAttribute('src', "/App/Views/img/HTML5_Logo.png");
		var b = document.querySelector('input[name="1"]:checked').value;
		if (b == "1")
			document.getElementById("super").setAttribute('src', "/App/Views/img/super/HTML5_Logo.png");
		if (b == "2")
			document.getElementById("super").setAttribute('src', "/App/Views/img/super/amazon.png");
		if (b == "3")
			document.getElementById("super").setAttribute('src', "/App/Views/img/super/facebook.png");
		if (b == "4")
			document.getElementById("super").setAttribute('src', "/App/Views/img/super/linkedin.png");
		if (b == "5")
			document.getElementById("super").setAttribute('src', "/App/Views/img/super/save.png");

		document.getElementById("post").style.display="block";
	});

}) ();

	function ajax() {

		let data = new FormData();
		data.append('data', document.getElementById('photo').getAttribute('src'));
		data.append('img-id', document.querySelector('input[name="1"]:checked').value);		
		var xhr = new XMLHttpRequest();
		xhr.open('POST', '/save-photo/', true);
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				console.log(xhr.responseText);
				window.location.href = '/user-page/';
			} 
		}
		xhr.send(data); 
	}

