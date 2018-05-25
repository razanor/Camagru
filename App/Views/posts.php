<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://127.0.0.1:8080/App/Views/css/styles.css" rel="stylesheet" type="text/css">
<title>Camagru</title>

</head>

<body>

<!-- Top navigation -->
<div class="topnav">

  <!-- Centered header -->
<div class="topnav-centered">
	<a style="pointer-events: none; cursor: default;" href="" id="header" class="active">Camagru</a>
</div>

<!-- Right-aligned links -->
<div class="topnav-right">
    <a class="log" href="/login/">Log in</a>
    <a class="logout" href="/">Back</a>
</div>
</div>
<div class="main-posts">
<div class="post-details">
<div class="login-name">
<p><?php echo $user['username']; ?></p>
<span><?php echo $picture['creation'] ?></span>
</div>
<img class="img" src="<?php echo $picture['path']; ?>" style="width:90%">
<div class="img-like">
<img src="http://127.0.0.1:8080/App/Views/img/like.png" alt="likes" width="50" height="50">
</div>
<div class="like-quantities">
<p><?php echo $picture['likes'] ?> likes</p>
</div>
<div class="comments-box">
<div id="comments">
	<?php foreach ($comments as $comment): ?>
	<p id="user"><b><?php echo $comment['username'] ?> - </b><?php echo $comment['comment'] ?></p>
	<?php endforeach; ?>
	</div>
</div>
</div>
</div>

<footer>
	<p>&#169 nrepak, 2018</p>
</footer>
</body>
</html>