<?php
	include("../modules/base/API.php");

	$article = json_decode($_POST['article']);

	$sql = "INSERT INTO articles (articleTitle, articleDesc, userID) VALUES('$article->TITLE', '$article->DESC', $USER->id)";
	$query = $db->prepare($sql);
	$query->execute();
	$articleID = $db->lastInsertId();

	foreach($article->PARAGRAPHS as $para){
		$sql = "INSERT INTO articles_paragraphs (article_paragraphTitle, article_paragraphText, articleID) VALUES('$para->TITLE', '$para->TEXT', $articleID)";
		$db->query($sql);
	}

	echo $articleID;

?>