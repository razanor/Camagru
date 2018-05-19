<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://127.0.0.1:8080/App/Views/css/styles.css" rel="stylesheet" type="text/css">
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
	<a data-id="<?php echo $picture['id']; ?>" href="#" onclick="popup()"><img class="img" src="<?php echo $picture['path']; ?>" style="width:100%"></a>
	</div>
<?php endforeach; ?>
</div>
<div class="popup" id="popup">
<div class="popup-container">
</div>
</div>


<footer>
	<p>&#169 nrepak, 2018</p>
</footer>
<script>
function popup() {
document.getElementById('popup').style.display="flex";
}
a = document.getElementsByTagName('a')[2];
a.addEventListener("click", function(e) {
    e.preventDefault();
    console.log(e.target);
	console.log(e.target.parentElement.dataset.id);
});
</script>
</body>
</html>