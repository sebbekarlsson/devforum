<?php

  include("../modules/base/API.php");

  $userID = $_POST['userID'];
  $nots = array();

  $result = $db->query("SELECT * FROM notifications WHERE recieverID=$userID ORDER BY notificationDate DESC");
  while(($row = $result->fetch()) != false){
    $notification = new Notification($row['notificationID']);
    $notification->fetch_build();
    array_push($nots, $notification);
  }

  echo json_encode($nots);

?>
