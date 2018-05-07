<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://127.0.0.1:8080/App/Views/css/styles.css" rel="stylesheet" type="text/css">
<title>Edit</title>

</head>

<body>

<header>
	<h1>Camagru</h1>
	<a class="edit-log" href="/user-page/"><img src="http://127.0.0.1:8080/App/Views/img/gallery.png" title="Gallery"  width="100px" height="100px"></a>
	<a class="logout" href="/logout/">Log out</a>
	<a class="add" href="/add/">Add photo</a>
</header>

<div class="main-login">
<h3>Hello, <?php echo $user['username'];?>!</h3>
	<form class="login-form form-edit" action="" method="post">
		<div class="update">
		<?php if ($result == true): ?>
		  <p>Update successfully</p>
		  <?php endif; ?>
		</div>
		<div class="error">
		<?php if (!empty($errors)): ?>
  	<ul>
      	<?php foreach ($errors as $error): ?>
        	<li> <?php echo $error; ?></li>
      	<?php endforeach; ?>
  	</ul>
	<?php endif; ?>
		</div>
		<p>Modify user data</p>
		<input type="text" name="name" placeholder="Change username"><br><br>
		<input type="submit" name="submit_name"><br><br>
		<input type="email" name="email" placeholder="Change email"><br><br>
		<input type="submit" name="submit_email"><br><br>
		<p>Change password</p>
  		<input type="password" name="old_password" placeholder="Old password"><br><br>
  		<input type="password" name="new_password" placeholder="New password"><br><br>
  		<input type="submit" name="submit_password"><br><br>
	</form>	
</div>

<footer>
	<p>&#169 nrepak, 2018</p>
</footer>

</body>
</html>