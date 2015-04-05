<?php
$result = $db->query("SELECT * FROM articles ORDER BY articleDate DESC");
?>

<table class="table">
  <tr class="table-head">
    <td>Title</td><td>Author</td><td>Date</td>
  </tr>

<?php

$alt = false;
while(($row = $result->fetch()) != false){
  $article = new Article($row['articleID']);
  $article->fetch_build();

  $publisher = new User($article->userID);
  $url = "index.php?doc=article.php&articleID=$article->id";

  ?>

    <tr <?php if($alt){echo "class='alt'";} ?>>
      <td><?php echo "<a href='$url'>".enquote($article->title)."</a>"; ?></td>
      <td><?php echo "$publisher->firstname $publisher->lastname"; ?></td>
      <td><?php echo $article->date; ?></td>
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
