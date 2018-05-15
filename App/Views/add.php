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
<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="file"><br>
<input type="submit" name="submit" value="Upload">
</form>

<footer>
	<p>&#169 nrepak, 2018</p>
</footer>

</body>
</html>
