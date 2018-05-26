<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="/App/Views/css/styles.css" rel="stylesheet" type="text/css">
<title>Camagru</title>

</head>

<body >

<!-- Top navigation -->
<div class="topnav">

  <!-- Centered header -->
<div class="topnav-centered">
	<a style="pointer-events: none; cursor: default;" href="" id="header" class="active">Camagru</a>
</div>

<!-- Right-aligned links -->
<div class="topnav-right">
	<a class="log" href="/login/">Log in</a>
</div>
</div>

<div class="row">
<?php foreach($pictures as $picture): ?> 
		<div class="column">
	<a title="View details" href="post/<?php echo $picture['id'] ?>"><img class="img" src="<?php echo $picture['path']; ?>" style="width:100%"></a>
	</div>
<?php endforeach; ?>
<footer>
	<p>&#169 nrepak, 2018</p>
</footer>
</body>
</html>