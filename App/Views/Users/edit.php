<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://127.0.0.1:8080/App/Views/css/styles.css" rel="stylesheet" type="text/css">
<title>Edit</title>

</head>

<body>

<!-- Top navigation -->
<div class="topnav">
	  <!-- Centered header -->
	<div class="topnav-centered">
		<a href="/user-page/" id="header" class="active" title="Home">Camagru</a>
	</div>

	<!-- Left-aligned links (default) -->
	<a class="add" href="/add/">Add photo</a>

	 <!-- Right-aligned links -->
	<div class="topnav-right">
		<a class="cabinet" href="/edit/">Cabinet</a>
		<a class="logout" href="/logout/">Log out</a>
	</div>

</div>

<div class="main-login">
<h3>Hello, <?php echo $user['username'];?>!</h3>
	<form data-id="<?php echo $userId ?>" class="login-form form-edit" action="" method="post">
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
  		<input type="submit" name="submit_password"><br>
		<p>Notification</p>
		<input type="button" value="On" id="onoff" onclick="notification()"> 
	</form>	
</div>

<footer>
	<p>&#169 nrepak, 2018</p>
</footer>
<script>
function notification() {

  currentValue = document.getElementById('onoff').value;
  var el = document.getElementsByClassName('login-form')[0];
  var id = el.dataset.id;

  var data = "id=" + id;

  if (currentValue == "Off") {
	document.getElementById("onoff").value="On";
	data += "&" + "notification=off";
	
  } else {

    document.getElementById("onoff").value="Off";
	data += "&" + "notification=on";
  }
  let xhr = new XMLHttpRequest();

	xhr.open('POST', '/notification/', true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.setRequestHeader("Content-lenght", data.lenght);
	xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				console.log(xhr.responseText); 
			}
		}
	
	xhr.send(data);
}
</script>
</body>
</html>