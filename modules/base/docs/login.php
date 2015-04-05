<form method="post">
	<div class="text center squeezed">
		<h2>Sign in to Devforum</h2>
		<p>
			<input type="email" name="login_email" class="intext struct" placeholder="Email">
			<input type="password" name="login_password" class="intext struct" placeholder="Password">
			<input type="submit" name="login" class="btn struct" value="Login">
		</p>
	</div>
</form>
<div class="text center squeezed">
	<?php

		
		if(isset($_POST['login'])){
			$ok = true;

			$email = $_POST['login_email'];
			$password = $_POST['login_password'];

			$result = $db->query("SELECT * FROM users WHERE userEmail='$email'");
			while(($row = $result->fetch()) != false){
				$realpass = $row['userPassword'];
				$userID = $row['userID'];
			}

			if($password != $realpass){
				$ok = false;
				echo "<p>Wrong password!</p>";
			}

			if($ok){
				$_SESSION['userID'] = $userID;
				echo "<script type='text/javascript'>window.location.href='.';</script>";
			}
		}

	?>
</div>