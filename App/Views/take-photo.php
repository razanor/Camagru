<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"> 
<title>Camera</title>
<link rel="stylesheet" href="http://127.0.0.1:8080/App/Views/css/photo.css">
</head>
<body>

	<div class="booth">
		<video autoplay="" id="video" width="400" height="300"></video>
		<a href="#" id="capture" class="booth-capture-button">Take photo</a>
		<canvas id="canvas" width="400" height="300"></canvas>
		<img id="photo" src="">
	</div>

	<p id="demo"></p>
	<script src="http://127.0.0.1:8080/App/Views/js/photo.js"></script>
</body>
</html>