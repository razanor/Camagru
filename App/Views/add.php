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
<div class="upload-error" style="margin: 5px;">
<?php if (!empty($errors)): ?>
			<ul>
				<?php foreach ($errors as $error): ?>
					<li><?php echo htmlspecialchars($error); ?></li>
					<?php endforeach; ?>
			</ul>
				<?php endif; ?>
</div>
<div class="main-picture">
<form action="" method="post" id="photo-list" enctype="multipart/form-data" name="fff">
		<input type="hidden" name="filetype" value="camera">
		<input id="choose-file" type="file" name="file" disabled="disabled">
		<input id="uploada" type="button" name="xxx" value="Upload" disabled="disabled"><br><br>

	<?php foreach($super as $each): ?>
	<input type="radio" name="1" value="<?php echo htmlspecialchars($each['id']); ?>" required><img class="list" src="<?php echo htmlspecialchars($each['path']); ?>" width="70" height="70">
	<?php endforeach ; ?>

		<video autoplay="" id="video" width="520" height="380"></video>
		<button type="submit" name="choose" value="Snap" id="capture" class="booth-capture-button">Snap</button>
		<canvas id="canvas" width="390" height="300"></canvas>
		<div id="absol">
			<img id="super" src="">
		</div>
		<div id="testa">
		<img id="photo" src="" widht="380" height="400">
		</div>
		<a href="#" id="post" class="booth-capture-button" onclick="ajax()" style="display:none;">Post</a>
</form>

<div class="thumbnails">
	<?php foreach ($allPhotoByUser as $each): ?>
		<div class="each-thumbnails">
			<img src="<?php echo htmlspecialchars($each['path']); ?>" width="250" height="200">
		</div>		
	<?php endforeach; ?>
</div>
</div>

<footer>
	<p>&#169 nrepak, 2018</p>
</footer>
<script src="/App/Views/js/photo.js"></script>
</body>
</html>
