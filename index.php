<html>
	<head>
		<style type="text/css" media="screen">
		.image {border: 1px solid black;float: left;height:100px;overflow: hidden;padding: 2px;vertical-align: text-bottom;width: 120px;}
		.loader{background: url(img/loading.gif) repeat; width:128px; height: 128px;}
		</style>
		<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="js/upload.js"></script>
       <script>
		$(function() {   
			$('#file').fileupload({src:'upload.php'});		
		});
	function uploadResponse(response)
	{
    	for(var i=0 ;i<response.length;i++)
    	{
    		  element = $("<div class='image'>");
			  image = $('<img>').attr({'src':response[i]['image']}).appendTo(element);
			  $(element).appendTo('#preview');
    	}
	}
	
	</script>
       
	</head>
	 <?php
	 /* labelvalContainer.push({"val":"<?php echo $items[$val];?>",'key':'<?php echo $val;?>'});*/
	?>
	<body>
		<form method="post" enctype="multipart/form-data" action="upload.php" >
		<table align='center'>
			<tr><td>Name :</td><td><input type="text" name="name" /></td></tr>
			<tr><td>Email :</td><td><input type="text" name="email" /></td></tr>
			<tr><td>Upload :</td><td><input type="file" name="file[]" id="file" multiple="multiple" /></td></tr>
		</table>
		</form>
		<div id="preview">
		</div>
	</body>
</html>		