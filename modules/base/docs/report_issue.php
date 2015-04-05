<form method="post">
  <div class="text center squeezed">
    <h2>Found an issue?</h2>
    <p>
      If you have found an issue, we are very happy to take a look at it.<br>
      Report the issue below, thank you.
    </p>
  </div>

  <div class="text center squeezed">
    <h2>Give us some info</h2>
    <p>
      <textarea name="issue_desc" class="inbigtext"></textarea>
    </p>
  </div>
  <div class="text center squeezed">
    <p>
      <input type="submit" class="btn" name="issue_publish" value="Publish">
    </p>
  </div>
</form>
<div class="text center squeezed">
<?php

  if(isset($_POST['issue_publish'])){
    $issue = new Issue();
    $issue->desc = $_POST['issue_desc'];
    $issue->userID = $USER->id;

    publish_issue($issue);
    echo "<p>Thanks for your support, your issue will be taken care of shortly.</p>";
  }

?>
</div>
