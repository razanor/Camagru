<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="/App/Views/css/styles.css" rel="stylesheet" type="text/css">
<link href="/App/Views/css/photo.css" rel="stylesheet" type="text/css">
<title>Add photo</title>

</head>

<body>

<!-- Top navigation -->
<div class="topnav">
	  <!-- Centered header -->
	<div class="topnav-centered">
		<a style="pointer-events: none; cursor: default;" href="" id="header" class="active">Camagru</a>
	</div>

	<!-- Left-aligned links (default) -->
	<a class="add" href="/user-page/">Back</a>

	 <!-- Right-aligned links -->
	<div class="topnav-right">
		<a class="cabinet" href="/edit/">Cabinet</a>
		<a class="logout" href="/logout/">Log out</a>
	</div>

</div>
<!-- <div class="main-photo">
<div class="action-photo">
<div class="upload-error">
<?php if (!empty($errors)): ?>
			<ul>
				<?php foreach ($errors as $error): ?>
					<li><?php echo htmlspecialchars($error); ?></li>
					<?php endforeach; ?>
			</ul>
				<?php endif; ?>
</div>
<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="file"><br><br>
<input type="submit" name="submit" value="Upload">
</form>
<a href="/take-photo/"><img src="/App/Views/img/webcam.png" title="Use webcam" alt="Take photo" width="100" height="100"></a>
</div>
</div> -->
<div class="main-picture">
<div class="booth">
<form action="" method="post" id="photo-list">
	<?php foreach($super as $each): ?>
	<input type="radio" name="1" value="<?php echo htmlspecialchars($each['id']); ?>" required><img src="<?php echo htmlspecialchars($each['path']); ?>" width="50" height="50">
	<?php endforeach ; ?>

		<video autoplay="" id="video" width="400" height="300"></video>
		<input type="submit" name="choose" value="Choose" id="capture" class="booth-capture-button">
		<canvas id="canvas" width="400" height="300"></canvas>
		<div id="absol">
			<img id="super" src="">
		</div>
		<img id="photo" src="">
		<a href="#" id="post" class="booth-capture-button" onclick="ajax()" style="display:none;">Post</a>
</form>
</div>
</div>

<footer>
	<p>&#169 nrepak, 2018</p>
</footer>
<script src="/App/Views/js/photo.js"></script>
</body>
</html>
