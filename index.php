<?php include("modules/base/API.php"); ?>
<?php

	$doc = $_GET['doc'];
	if(!isset($_GET['doc'])){
		$doc = "articles.php";
	}
	$file = "modules/base/docs/$doc";

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<link href='http://fonts.googleapis.com/css?family=Ubuntu:300' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="apps/jquery.js"></script>
		<script type="text/javascript" src="apps/svg.js"></script>
		<script type="text/javascript" src="apps/main.js"></script>
		<meta charset="utf-8">
		<?php include("modules/base/highlight.php"); ?>
	</head>

	<body>
		<div class="content">
			<?php include("modules/base/notifications.php"); ?>
			<div class="rightcontent">
					<?php
						if(file_exists($file) && strlen($doc) > 2){
							include($file);
						}
					?>
			</div>
			<div class="leftcontent">
				<?php include("modules/base/navigation.php"); ?>
			</div>
		</div>
		<div style="clear:both;"></div>
		<?php include("modules/base/navigation_bottom.php"); ?>
	</body>

	<footer>
	</footer>
</html>
