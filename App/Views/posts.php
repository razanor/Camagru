<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="/App/Views/css/styles.css" rel="stylesheet" type="text/css">
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
<p id="userComment"><?php echo htmlspecialchars($user['username']); ?></p>
<p id="creation"><?php echo htmlspecialchars($picture['creation']) ?><p>
<div class="clear">
</div>
</div>
<div class="img-like">
<img class="img" src="<?php echo htmlspecialchars($picture['path']); ?>" style="width:90%">
<img src="/App/Views/img/like.png" alt="likes" width="50" height="50">
<span class="like-quantities"><span id="likes-number"><?php echo htmlspecialchars($picture['likes']); ?></span> likes</span>
</div>
<div class="comments-box">
<div id="comments">
	<?php foreach ($comments as $comment): ?>
	<p id="user"><b><?php echo htmlspecialchars($comment['username']) ?> - </b><?php echo htmlspecialchars($comment['comment']) ?></p>
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