<?php

	$articleID = $_GET['articleID'];
	$article = new Article($articleID);
	$article->fetch_build();

	$article->render();


?>

<div class="text center squeezed">
	<button class="btn" onclick="return showSource();">Show Source</button>
</div>

<div class="text center squeezed" id="article_source" style="display:none; opacity:0;">
	<code>
		<?php echo syntaxify(enquote($article->text)); ?>
	</code>
</div>
<div class="comments-section">
</div>

<script type="text/javascript">
	function showSource(){
		$("#article_source").css("display","block");
		$("#article_source").animate({
			opacity:"1"
		},1000);
	}
</script>
