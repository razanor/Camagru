<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://127.0.0.1:8080/App/Views/css/styles.css" rel="stylesheet" type="text/css">
<title>Log in</title>

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
<a class="log" href="/">Gallery</a>
</div>
</div>

<div class="main-login">
	<form class="login-form reset-form" action="" method="post">
		<p>Reset password</p>
		<div class="error">
			<?php if (!empty($errors)): ?>
			<ul>
				<?php foreach ($errors as $error): ?>
					<li><?php echo $error; ?></li>
					<?php endforeach; ?>
			</ul>
				<?php endif; ?>
			</div>
            <?php if ($result === true): ?>
            <p class="register" style="color:blue;">To reset password check your email</p><br>
        <?php else: ?>
		<input type="text" name="email" placeholder="Your email"><br><br>
  		<input type="submit" name="submit" value="Submit"><br><br>
  		<hr>
  		<a href="/login/">Log in</a>
    <?php endif; ?>
	</form>	
</div>

<footer>
	<p>&#169 nrepak, 2018</p>
</footer>

</body>
</html>