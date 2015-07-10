<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Memester! - Just Another Meme Site</title>
<link rel="stylesheet" href="style/style.css" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
		var memes = new Array();
		var items_per_line = 0;
		
		for(var i = 0 ; i < 15; i++){
			memes.push(i);
		}
		
		addAds();
		placeMemes();
		resize();
		
		$(window).on('resize', function(){
				resize();
		});
		
		function resize(){
			var initial_width = $(".spotlight_list_item").width();
			var container_width = $("#top_memes").width();
			var current_margin = parseFloat($(".spotlight_list_item").css('margin-left'));
			var items_per_line = Math.floor(container_width / 280);
			if (items_per_line < 1){
				items_per_line = 1;
			}
			var empty_space = container_width % 280;
			var new_margin = Math.floor(empty_space / (items_per_line + 1));
			new_margin += 5;
			$(".spotlight_list_item").css('margin-left', new_margin + 'px');
			items_per_line = (container_width - (container_width % (new_margin + 275))) / (275 + new_margin);
			
			/* fit some ads in with the additional space */
		}
		
		function addAds(){
			for(var i = 0; i < 3; i++){
				memes.push("Ad " + i);
			}
			
			memes.sort(function() { return 0.5 - Math.random() });
		}
		
		function placeMemes(){
			$.each(memes, function(index, row){
					$("#top_memes .spotlight_list").append("<div class='spotlight_list_item'>" + row + "</div>");
			});
		}
});
</script>
</head>
<body>
<div id="container">
	<?php include('header.php'); ?>
	<div id="middle">
		<div id="top_memes">
			<div class="spotlight_title">
				Top Memes
			</div>
			<div class="spotlight_list">

			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<?php include('footer.php'); ?>
</div>
</body>
</html>
