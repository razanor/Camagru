<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://127.0.0.1:8080/App/Views/css/styles.css" rel="stylesheet" type="text/css">
<title>User</title>

</head>

<body>

<header>
	<h1>Camagru</h1>
	<a class="cabinet" href="/edit/">Cabinet</a>
	<a class="logout" href="/logout/">Log out</a>
	<a class="add" href="/add/">Add photo</a>
</header>

<div class="row">
<?php foreach($pictures as $picture): ?> 
		<div class="column">
	<img class="img" src="<?php echo $picture['name']; ?>" style="width:100%">
	</div>
<?php endforeach; ?>
</div>

<footer>
	<p>&#169 nrepak, 2018</p>
</footer>

</body>
</html>