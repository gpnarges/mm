<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Memester! - Add a New Meme</title>
<link rel="stylesheet" href="style/style.css" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
		$("#addmemeleft").on('click', function(){
				$("#imageinput").click();
		});
		
		$("#imageinput").on('change', function(){
				readURL(this);
		});
		
		function readURL(input) {
			
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function (e) {
					$("#addmemeleft").html('<img id="imagepreview">');
					$("#addmemeleft").css('padding', '0px');
					$("#imagepreview").attr('src', e.target.result);
					$("#addmemeleft").css('min-height', '0px');
					$("#addmemeleft").css('font-size', '0px');
					
					setTimeout(function(){
							//$("#addmemeleft").css('height', ($("#imagepreview").height() > 450) ? $("#imagepreview").height() + 'px' : 450 + 'px');
							/*
							if ($("#imagepreview").height() < $("#addmemeleft").height()){
								$("#imagepreview").css('margin-top', ($("#addmemeleft").height() - $("#imagepreview").height()) / 2 + 'px');
							}else{
								$("#imagepreview").css('margin-top', '0px');
							}*/
					}, 50);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
	
		$("#submitmeme").on('click', function(){
				var datastring = "name=" + $("#memename").val() + "&picdata=" + $("#imagepreview").attr('src');
				
				$.ajax({
						type: "POST",
						url: "ajax/uploadtemplate.php",
						data: datastring,
						success: function(response){
							alert(response);
						}
				});	
		});
});
</script>
</head>
<body>
<div id="container">
	<?php include('header.php'); ?>
	<div id="middle">
		<div id="addmemecontainer">
			<div id="addmemeleft">
				<div style="width: 200px; margin: 40% auto;">Click to Upload an Image</div>
			</div>
			<div id="addmemeright">			
				<input class="create_input" id="memename" type="text" placeholder="Meme Name Here"><br /><br />
				<input type="checkbox" id="tos"> By checking this box I aknowledge that I have read and agree to the Terms of Service and Privacy Policy<br /><br /><br /><br />
				<div id="submitmeme" class="button">Submit Meme!</div>
				<form style="display: none;">
					<input id="imageinput" type="file" name="images" id="images"/> 
				</form>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<?php include('footer.php'); ?>
</div>
</body>
</html>
