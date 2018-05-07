<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://127.0.0.1:8080/App/Views/css/styles.css" rel="stylesheet" type="text/css">
<title>Sign up</title>

</head>

<body>

<header>
	<h1>Camagru</h1>
	<a class="log" href="/"><img src="http://127.0.0.1:8080/App/Views/img/gallery.png" title="Gallery"  width="100px" height="100px"></a>
</header>

<div class="main-login">

	<form class="login-form" id="register-form" action="" method="post">
	<p>Sign up</p>
	<?php if ($result == true): ?>
		<p class="register"> You are susscesfully register!</p><br>
    	<p><a href="/login/">Log in</a></p>
	<?php else: ?>
	<div class="error">
    	<?php if (!empty($errors)): ?>
	<ul>
        	<?php foreach ($errors as $error): ?>
            	<li><?php echo $error; ?></li>
        	<?php endforeach; ?>
	</ul>
		<?php endif; ?>
	</div>
		<input type="text" name="name" placeholder="Username"><br><br>
		<input type="email" name="email" placeholder="Email"><br><br>
  		<input type="password" name="password" placeholder="Password"><br><br>
		<input type="password" name="password_repeat" placeholder="Repeat password"><br><br>
  		<input type="submit" name="submit" value="Sign up"><br><br>
  		<hr>
		<a href="/login/">Already a member?</a>
		 	<?php endif; ?>
	</form>	
</div>

<footer>
	<p>&#169 nrepak, 2018</p>
</footer>

</body>
</html>