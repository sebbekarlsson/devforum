<?php
	
	session_start();
	$_SESSION['userID'] = null;
	unset($_SESSION['userID']);

?>
<script type="text/javascript">
	window.location.href=".";
</script>