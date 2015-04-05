<?php
$result = $db->query("SELECT * FROM users ORDER BY devtypeID");
?>

<table class="table">
  <tr class="table-head">
    <td>Name</td><td>Devtype</td>
  </tr>

<?php

$alt = false;
while(($row = $result->fetch()) != false){
  $u = new User($row['userID']);
  $url = "index.php?doc=profile.php&id=$u->id";

  ?>

    <tr <?php if($alt){echo "class='alt'";} ?>>
      <td><?php echo "<a href='$url'>".enquote("$u->firstname $u->lastname")."</a>"; ?></td>
      <td><?php echo get_devtype_name($u->devtypeID); ?></td>
    </tr>

  <?php

  if($alt){
    $alt = false;
  }else{
    $alt = true;
  }

}

?>
</table>
