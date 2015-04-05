<form method="post" id="article_form" enctype="multipart/form-data">
	<div class="text center squeezed">
		<h2>Create an Article</h2>
		<p>
			<input type="text" name="article_title" id="article_title" class="intext struct" placeholder="Title">
			<textarea name="article_text" id="article_text" class="inlargetext struct" placeholder="Article Content"></textarea>
		</p>
	</div>
	<div class="text center squeezed">
		<h2>Make it official</h2>
		<p>
			<input type="submit" class="btn struct" name="publish_article" value="Publish Article">
		</p>
	</div>
</form>
<?php

	if(isset($_POST['publish_article'])){
		$article = new Article();
		$article->title = $_POST['article_title'];
		$article->text = $_POST['article_text'];
		$article->userID = $USER->id;
		$article->image = "image.jpg";

		publish_article($article);
	}

?>
<div class="text center squeezed">
	<h2>Need some help?</h2>
	<a href="index.php?doc=article_help.php">Check out the syntax</a>

</div>
