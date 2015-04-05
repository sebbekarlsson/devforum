<?php

  include("../modules/base/API.php");

  $notificationID = $_GET['ID'];

  $notification = new Notification($notificationID);
  $notification->fetch_build();
  $url = $notification->url;

  delete_notification($notification->id);

?>

<a class="btn struct" href="<?php echo "../".$url; ?>">Continue</a>
