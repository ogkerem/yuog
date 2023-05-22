<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>append demo</title>
  <style>
  p {
    background: yellow;
  }
  </style>
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
</head>
<body>
 
 
 
 <a href="#"> Ekle </a>
 <div id="denemeee"></div>
 
 
	<script type="text/javascript"> 
		$(function(){
		 
			$("a").click(
			function(){
				$("#denemeee").append('<div class="yeni" id="10" > Burasy yeni div </div>');
			}) 
		});
		</script> 		
		
		
 
</body>
</html>