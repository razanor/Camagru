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
    <a class="log" href="/user-page/">Back</a>
    <a class="logout" href="/logout/">Log out</a>
</div>
</div>
<div class="main-posts">
<div class="post-details">
<div class="login-name">
<p><?php echo $user['username']; ?></p>
<span><?php echo $picture['creation'] ?></span>
</div>
<img data-id="<?php echo $picture['id']?>" id="id-img" class="img"  src="<?php echo $picture['path']; ?>" style="width:90%">
<div class="img-like">
<button id="like-button" onclick="ajaxLike()"><img src="http://127.0.0.1:8080/App/Views/img/like.png" alt="like" title="Like" width="50" height="50"></button>
<button id="dislike-button" onclick="ajaxDislike()"><img src="http://127.0.0.1:8080/App/Views/img/dislike.png" alt="dislike" title="Dislike" width="50" height="50"></button>
</div>
<div class="like-quantities">
	<p><span id="likes-number"><?php echo $picture['likes'] ?></span> likes</p>
</div>
<div class="comments-box">
	<textarea id="comment-box"></textarea>
	<br>
	<button id="submit-comment" type="button">Comment</buttom>

</div>
</div>
</div>

<footer>
	<p>&#169 nrepak, 2018</p>
</footer>
<script>
function ajaxLike() {
	document.getElementById("like-button").style.display="none";
	document.getElementById("dislike-button").style.display="inline";
    var el = document.getElementById("id-img");
    var id = "data=" + el.dataset.id;
    var xhr = new XMLHttpRequest();
		xhr.open('POST', '/like-post/', true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.setRequestHeader("Content-lenght", id.lenght);
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {1
				console.log(xhr.responseText);
				 let likes = document.getElementById('likes-number');
				 likes.innerHTML = parseInt(likes.innerHTML) + 1;
			} 
		}
		xhr.send(id); 
}

function ajaxDislike() {
	document.getElementById("like-button").style.display="inline";
	document.getElementById("dislike-button").style.display="none";
    var el = document.getElementById("id-img");
    var id = "data1=" + el.dataset.id;
    var xhr = new XMLHttpRequest();
		xhr.open('POST', '/like-post/', true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.setRequestHeader("Content-lenght", id.lenght);
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {1
				console.log(xhr.responseText);
				 let likes = document.getElementById('likes-number');
				 likes.innerHTML = parseInt(likes.innerHTML) - 1;
			} 
		}
		xhr.send(id); 
}
</script>
</body>
</html>