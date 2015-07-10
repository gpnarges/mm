<?php
$top_text = (isset($_GET['top'])) ? $_GET['top'] : '';
$bottom_text = (isset($_GET['bottom'])) ? $_GET['bottom'] : '';
$template = (isset($_GET['template'])) ? $_GET['template'] : 'fry.jpg';
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style/style.css" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
		$.ajax({
				type: "GET",
				url: "/ajax/gettemplates.php",
				dataType: 'json',
				success: function(templates){
					$.each(templates, function(index, row) {   
							$('#template')
							.append($("<option></option>")
								.attr("value", row.file)
								.text(row.name)); 
					});
				}
		});
		
		var WIDTH = 500;
		var HEIGHT = 375;
		
		$("#template").val('<?php echo $template; ?>');
		
		var canvas = $('#create_canvas')[0].getContext("2d");
		canvas.canvas.width = WIDTH;
		canvas.canvas.height = HEIGHT;
		
		var background = new Image();
		background.src = '/images/' + $("#template").val();
		$("#hide_me").attr('src', '/images/' + $("#template").val());
		
		setTimeout(function(){Draw();}, 500);
		
		$(document).on('keyup', function(){
				Draw();
		});
		
		function Draw(){
			//draw the background
			canvas.drawImage(background, 0, 0, WIDTH, HEIGHT);
			
			//draw the text
			DrawTopText();
			DrawBottomText();
		}
		
		function DrawTopText(){
			var total_text = $("#create_top_text").val();
			var array_text = total_text.trim().split(' ');
			var temp_text = '';
			var lines = 1;
			var y_offset = 0;
			var fontsize = 50;
			var text_max_width = WIDTH * .9;
			
			canvas.font = "bold 50px Impact";
			canvas.fillStyle = 'white';
			canvas.strokeStyle = 'black';
			canvas.lineWidth = 2;
			
			for(var i = 0; i < array_text.length; i++){
				if (canvas.measureText(temp_text).width + canvas.measureText(' ' + array_text[i]).width < text_max_width){
					if (temp_text == ''){
						temp_text = array_text[i];
					}else{
						temp_text += ' ' + array_text[i];
					}
				}else{
					canvas.fillText(temp_text, (text_max_width - canvas.measureText(temp_text).width) / 2 + 25, lines * fontsize + y_offset);
					canvas.strokeText(temp_text, (text_max_width - canvas.measureText(temp_text).width) / 2 + 25, lines * fontsize + y_offset);
					lines++;
					temp_text = array_text[i];
				}
			}
			
			if (temp_text != ''){
				canvas.fillText(temp_text, (text_max_width - canvas.measureText(temp_text).width) / 2 + 25, lines * fontsize + y_offset);
				canvas.strokeText(temp_text, (text_max_width - canvas.measureText(temp_text).width) / 2 + 25, lines * fontsize + y_offset);
			}
		}
		
		function DrawBottomText(){
			var total_text = $("#create_bottom_text").val();
			var array_text = total_text.trim().split(' ');
			var temp_text = '';
			var lines = 1;
			var y_offset = HEIGHT - 120;
			var fontsize = 50;
			var text_max_width = WIDTH * .9;
			
			canvas.font = "bold 50px Impact";
			canvas.fillStyle = 'white';
			canvas.strokeStyle = 'black';
			canvas.lineWidth = 2;
			
			for(var i = 0; i < array_text.length; i++){
				if (canvas.measureText(temp_text).width + canvas.measureText(' ' + array_text[i]).width < text_max_width){
					if (temp_text == ''){
						temp_text = array_text[i];
					}else{
						temp_text += ' ' + array_text[i];
					}
				}else{
					canvas.fillText(temp_text, (text_max_width - canvas.measureText(temp_text).width) / 2 + 25, lines * fontsize + y_offset);
					canvas.strokeText(temp_text, (text_max_width - canvas.measureText(temp_text).width) / 2 + 25, lines * fontsize + y_offset);
					lines++;
					temp_text = array_text[i];
				}
			}
			
			if (temp_text != ''){
				canvas.fillText(temp_text, (text_max_width - canvas.measureText(temp_text).width) / 2 + 25, lines * fontsize + y_offset);
				canvas.strokeText(temp_text, (text_max_width - canvas.measureText(temp_text).width) / 2 + 25, lines * fontsize + y_offset);
			}
		}
		
		$("#create_top_text, #create_bottom_text").on('keyup', function(){
				$("#create_share").text('http://www.memester.net/create.php?top=' + encodeURIComponent($("#create_top_text").val()) + '&bottom=' + encodeURIComponent($("#create_bottom_text").val()) + '&template=' + encodeURIComponent($("#template").val()));
		});
		
		$("#template").on('change', function(){
				$("#hide_me").attr('src', '/images/' + $(this).val());
				background.src = '/images/' + $(this).val();
				$("#create_share").text('http://www.memester.net/create.php?top=' + encodeURIComponent($("#create_top_text").val()) + '&bottom=' + encodeURIComponent($("#create_bottom_text").val()) + '&template=' + encodeURIComponent($(this).val()));
				Draw();
		});
		
		$("#hide_me").on('load', function(){
				HEIGHT = $(this).height();
				WIDTH = $(this).width();
				
				if (WIDTH > 500){
					var ratio = 500/WIDTH;
					HEIGHT *= ratio;
					WIDTH *= ratio;
				}
				
				canvas.canvas.width = WIDTH;
				canvas.canvas.height = HEIGHT;

				Draw();
		});
});
</script>
</head>
<body>
<div id="container">
	<?php include('header.php'); ?>
	<div id="middle">
			<div id="addmemecontainer">
				<div id="create_tools">
					Pick your Meme<br />
					<select id="template" class="create_select">
						<option value="fry.jpg">Fry</option>
						<option value="spongebob.jpg">I'll have you know</option>
						<option value="timetofap.jpg">Time to fap</option>
						<option value="cat.jpg">Bro Cat</option>
						<option value="oldman.jpg">Old man</option>
						<option value="tech.jpg">Family Tech Guy</option>
						<option value="fbgirl.jpg">Annoying FB Girl</option>
					</select><br />
					Top Text<br />
					<input id="create_top_text" class="create_input" value="<?php echo $top_text; ?>"/><br />
					Bottom Text<br />
					<input id="create_bottom_text" class="create_input" value="<?php echo $bottom_text; ?>"/><br />
					Share<br />
					<textarea id="create_share"><?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?></textarea>
					<br /><br />
					<div id="submitmeme" class="button">WTF does this do?</div><br /><br />
					<div id="submitmeme" class="button">Submit Meme!</div>
				</div>
				
				<div id="create_image">
					<center><canvas id="create_canvas"></canvas></center>
				</div>
				
				<img src='' id="hide_me" style="display: none;">
				
				<div style="clear: both;"></div>
			</div>
	</div>
	<?php include('footer.php'); ?>
</div>
</body>
</html>
