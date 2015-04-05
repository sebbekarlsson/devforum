<?php

  $userID = $_GET['id'];
  if(!isset($_GET['id'])){
    $userID = $USER->id;
  }

  $u = new User($userID);

  $group = new Usergroup($u->usergroupID);
  $group->fetch_build();
?>

<div class="navbar navbar-top">
  <div class="left">
    <ul>
      <?php
        if($USER->id != $u->id){
          ?>
          <li><a class="navbtn">Add as Friend</a></li>
          <li><a class="navbtn">Send Message</a></li>
          <?php
        }
      ?>
    </ul>
  </div>
  <div class="right">
    <ul>
      <?php
        if($USER->id == $u->id){
          ?>
          <li><a class="navbtn">Settings</a></li>
          <?php
        }
      ?>
    </ul>
  </div>
</div>
<div class="profile-header">
  <div class="text center squeezed profile-image-section">
    <div class="profile-image">
    </div>
  </div>
  <div class="text center squeezed profile-info-section">
    <h2><?php echo "$u->firstname $u->lastname"; ?></h2>
    <p><?php echo get_devtype_name($u->devtypeID); ?></p>
  </div>
</div>
