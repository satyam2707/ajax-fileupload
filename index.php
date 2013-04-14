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
			$('#file').fileupload('upload.php');
			
				
		});
		$(function() {   
			$('#file1').fileupload('upload.php',{'frameId':'frame','frameName':'frame','multiple':true});		
		});
		
		function uploadResponse(result)
		{
		
	    	for(var i=0 ;i<result.length;i++)
	    	{
	    		  element = $("<div class='image'>");
				  image = $('<img>').attr({'src':result[i]['image']}).appendTo(element);
				  $(element).appendTo('#preview');
	    	}
		}
		function GetResponse()
		{
			
		}
	
	</script>
       
	</head>
	 <?php
	 /* labelvalContainer.push({"val":"<?php echo $items[$val];?>",'key':'<?php echo $val;?>'});*/
	?>
	<body>
		<form method="post" enctype="multipart/form-data" id="test">
		<table align='center'>
			<tr><td>Name :</td><td><input type="text" name="name" /></td></tr>
			<tr><td>Email :</td><td><input type="text" name="email" /></td></tr>
			<tr><td>Upload :</td><td><input type="file" name="file[]" id="file"/></td></tr>
		</table>
		</form>
		<div id="preview">
		</div>
		
		<form method="post" enctype="multipart/form-data">
		<table align='center'>
			<tr><td>Name :</td><td><input type="text" name="name" /></td></tr>
			<tr><td>Email :</td><td><input type="text" name="email" /></td></tr>
			<tr><td>Upload :</td><td><input type="file" name="file[]" id="file1"/></td></tr>
		</table>
		</form>
		
	</body>
</html>		