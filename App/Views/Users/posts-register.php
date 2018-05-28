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
    <a class="log" href="/user-page/">Back</a>
    <a class="logout" href="/logout/">Log out</a>
</div>
</div>
<div class="main-posts">
<div class="post-details">
<div class="login-name">
<p><?php echo htmlspecialchars($userComment); ?></p>
<span><?php echo htmlspecialchars($picture['creation']); ?></span>
</div>
<img data-id="<?php echo htmlspecialchars($picture['id']);?>" id="id-img" class="img"  src="<?php echo htmlspecialchars($picture['path']); ?>" style="width:90%">
<div class="img-like">
<?php
	$img = ($likesFlag === true)
	? "/App/Views/img/dislike.png"
	: "/App/Views/img/like.png"
;
	$onclick = ($likesFlag === true) 
	? "ajaxDislike()"
	: "ajaxLike()"
;
	$title = ($likesFlag === true)
	? "Dislike"
	: "Like"
;
?>
<button onclick="<?php echo htmlspecialchars($onclick); ?>"><img id="like-button" src="<?php echo htmlspecialchars($img); ?>" alt="like" title="<?php echo htmlspecialchars($title); ?>" width="50" height="50"></button>
</div>
<div class="like-quantities">
	<p><span id="likes-number"><?php echo htmlspecialchars($picture['likes']); ?></span> likes</p>
</div>
<div class="comments-box">
	<textarea id="comment-box"></textarea>
	<br>
	<button id="submit-comment" type="button">Comment</button>
	<div id="comments" data-parent="<?php echo htmlspecialchars($userName); ?>">
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

<script src="/App/Views/js/like-comments.js"></script>
</body>
</html>