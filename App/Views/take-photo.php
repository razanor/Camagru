<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"> 
<title>Camera</title>
<link rel="stylesheet" href="/App/Views/css/photo.css">
</head>
<body>
	<div class="booth">
		<video autoplay="" id="video" width="400" height="300"></video>
		<a href="#" id="capture" class="booth-capture-button">Take photo</a>
		<canvas id="canvas" width="400" height="300"></canvas>
		<img id="photo" src="">
		<a href="#" id="post" class="booth-capture-button" onclick="ajax()" style="display:none;">Post</a>
	</div>
	<script src="/App/Views/js/photo.js"></script>
</body>
</html>