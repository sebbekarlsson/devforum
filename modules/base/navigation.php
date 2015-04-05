<div class="navmenu">
	<ul>
		<li class="nobtn"><span><input onkeyDown="return fetchResults();" type="text" class="intext" id="s" placeholder="Search..."></span>
		</li>
		<li class="nobtn hidden_search">
			<span>
				<div id="search_results"></div>
			</span>
		</li>
		<li><a class="menubtn" href="index.php?doc=articles.php"><span>Articles</span></a></li>
		<li><a class="menubtn" href="index.php?doc=developers.php"><span>Developers</span></a></li>
		<?php
			if(!isLoggedin()){
				?>
					<li><a class="menubtn" href="index.php?doc=login.php"><span>Login</span></a></li>
					<li><a class="menubtn" href="index.php?doc=register.php"><span>Register</span></a></li>
				<?php
			}else{
				?>
					<li><a class="menubtn" href="index.php?doc=article_creator.php"><span>Create Article</span></a></li>
					<li><a class="menubtn" href="index.php?doc=profile.php"><span>Your Profile</span></a></li>
					<li><a class="menubtn" href="logout.php"><span>Logout</span></a></li>
				<?php
			}
		?>
	</ul>
</div>
<script type="text/javascript">
	function fetchResults(){
		var DOM = $("#search_results");
		var typed = $("#s").val();
		$(".hidden_search").css("display","none");
		if(typed.length >= 2){
			var fetched = false;

			if(fetched == false){
				var request = $.ajax({
					type:"post",
					cache:false,
					url:"apps/search.php",
					data:{input:typed}
				});

				fetched = true;
				request.done(function(data){
					$(".hidden_search").css("display","block");
					DOM.html(data);
				});
			}
		}
	}
</script>
