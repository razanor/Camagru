<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://127.0.0.1:8080/App/Views/css/styles.css" rel="stylesheet" type="text/css">
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
<div class="main-photo">
<div class="action-photo">
<div class="upload-error">
<?php if (!empty($errors)): ?>
			<ul>
				<?php foreach ($errors as $error): ?>
					<li><?php echo $error; ?></li>
					<?php endforeach; ?>
			</ul>
				<?php endif; ?>
</div>
<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="file"><br><br>
<input type="submit" name="submit" value="Upload">
</form>
<a href="/take-photo/"><img src="http://127.0.0.1:8080/App/Views/img/webcam.png" title="Use webcam" alt="Take photo" width="100" height="100"></a>
</div>
</div>
<footer>
	<p>&#169 nrepak, 2018</p>
</footer>

</body>
</html>
