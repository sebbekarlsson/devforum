<?php

	$result = $db->query("SELECT * FROM devtypes");
	$developers = $result->fetchAll();

?>
<form method="post" action="index.php?doc=register.php">
	<div class="text center squeezed">
		<h2>The basics</h2>
		<p>
			<input type="email" name="register_email" class="intext struct" placeholder="Email">
			<input type="text" name="register_firstname" class="intext struct" placeholder="Firstname">
			<input type="text" name="register_lastname" class="intext struct" placeholder="Lastname">
			<input type="password" name="register_password1" class="intext struct" placeholder="Password">
			<input type="password" name="register_password2" class="intext struct" placeholder="Confirm password">
		</p>
	</div>
	<div class="text center squeezed">
		<h2>What type of developer are you?</h2>
		<p>
			<select name="register_devtype" class="struct">
				<?php

					foreach($developers as $dev){
						$devtype = $dev['devtypeName'];
						$devtypeID = $dev['devtypeID'];
						echo "<option value='$devtypeID'>$devtype</option>";
					}

				?>
			</select><br>
		</p>
	</div>
	<div class="text center squeezed">
		<h2>That's it!</h2>
		<p>
			<input type="submit" name="register" class="btn struct" value="Register!">
		</p>
	</div>
</form>
<div class="text center squeezed">
	<?php

		if(isset($_POST['register'])){

			$ok = true;

			$data = array(
				"email" => $_POST['register_email'],
				"firstname" => $_POST['register_firstname'],
				"lastname" => $_POST['register_lastname'],
				"password1" => $_POST['register_password1'],
				"password2" => $_POST['register_password2'],
				"devtype" => $_POST['register_devtype']
			);

			$dataObject = (Object) $data;

			if($dataObject->password1 != $dataObject->password2){
				echo "<p>The passwords does not match!</p>";
				$ok = false;
			}

			foreach($data as $value){
				$vname = array_search($value, $data);
				if(strlen($value) < 3 && $vname != "devtype"){
					echo "<p>$vname needs to be larger than 3 characters!</p><br>";
					$ok = false;
				}
			}

			if($ok){
				$sql = "INSERT INTO users (devtypeID, userFirstname, userLastname, userEmail, userPassword, profileID, usergroupID) VALUES($dataObject->devtype, '$dataObject->firstname', '$dataObject->lastname', '$dataObject->email', '$dataObject->password1',-1, 1)";

				$query = $db->prepare($sql);
				$query->execute();
				$id = $db->lastInsertId();

				$note = new Notification();
				$note->message = "You havent created a profile yet! Create one now!";
				$note->recieverID = $id;
				$note->url = "index.php?doc=profile.php&id=$id";
				publish_notification($note);

				?>
					<div class="text">
						<h2>Successfully registered!</h2>
						<p>
							You have successfully registered an account connected to the
							email: <i><?php echo $dataObject->email; ?></i><br>
							When logging in you will be able to create your profile and give us some more information
							about yourself.<br><br>
							<h3>Welcome <?php echo "$dataObject->firstname."; ?></h3>
						</p>
					</div>
				<?php
			}
		}

	?>
</div>
