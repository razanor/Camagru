<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="/App/Views/css/styles.css" rel="stylesheet" type="text/css">
<title>Sign up</title>

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

	<form class="login-form" id="register-form" action="" method="post">
	<p>Sign up</p>
	<?php if ($mail === true): ?>
		<p class="register" style="color:blue;">Confirmanition link has been sent to your email!</p><br>
	<?php else: ?>
	<div class="error">
    	<?php if (!empty($errors)): ?>
	<ul>
        	<?php foreach ($errors as $error): ?>
            	<li><?php echo htmlspecialchars($error); ?></li>
				<?php break ; ?>
        	<?php endforeach; ?>
	</ul>
		<?php endif; ?>
	</div>
	<?php
	$value1 = isset($_SESSION['name'])
	? $_SESSION['name']
	: ""
;
	$value2 = isset($_SESSION['email'])
	? $_SESSION['email']
	: ""
	
;
?>	
		<input type="text" name="name" placeholder="Username" value="<?php echo htmlspecialchars($value1) ?>"><br><br>
		<input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($value2) ?>"><br><br>
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