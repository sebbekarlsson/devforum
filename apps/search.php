<?php

  include("../modules/base/API.php");

  $input = $_POST['input'];

  $result = $db->query("SELECT * FROM articles WHERE articleText LIKE '%$input%' LIMIT 10");
  while(($row = $result->fetch()) != false){
    $article = new Article($row['articleID']);
    $article->fetch_build();

    $url = "index.php?doc=article.php&articleID=$article->id";

    ?>
      <li class="result"><a href="<?php echo $url; ?>"><?php echo $article->title; ?></a></li>
    <?php

  }

?>
