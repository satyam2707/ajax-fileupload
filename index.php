<html>
	<head>
		<style type="text/css" media="screen">
		.image {border: 1px solid black;float: left;height:100px;overflow: hidden;padding: 2px;vertical-align: text-bottom;width: 120px;}
		.loader{    background: url("img/loader.gif") no-repeat scroll 0 0 transparent;float: right;margin: 2px 5px 5px;width: 25px;}
		.outerWrapper{margin: 50px;}
		.outerWrapper h1{font-size: 20px;}
		.outerWrapper p{ font-size:16px;
		    line-height: 1.5;
		    margin: 5px 0;}
		.wrapper{float: left;width: 100%; margin: 10px 0 10px 0; border-bottom: 2px solid black; padding-bottom: 25px;}
		.wrapper p{float: left; font-size: 16px;width: 100%; color:green;}
       .uploadWrapper{float: left; width:auto;}
       .uploadWrapper dl{ padding:10px 0px;}
       .uploadWrapper dd{float:left;}
       .uploadWrapper dt{float:left;width:150px;}
       #loader{ color: green;
    float: left;
    font-weight: bold;
    padding: 2px 10px;
}
		</style>
		<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="js/upload.js"></script>
	</head>
	<body>
<div class="outerWrapper">
	<h1>Welcome to jQuery Ajax Fileupload!!</h1>
   <p>This page demonstrates that how to use this plugin.It can be used in following ways.</p>
   <hr>
<div class="wrapper">
     <h3>1. Single file upload</h3>
      <script  type="text/javascript">
		$(function() {   
			$('#file').fileupload('upload.php',{
				                                onComplete : function(result){
							                                	for(var i=0,len=result.length;i<len;i++){
							                        	    		  element = $("<div class='image'>");
							                        				  image = $('<img>').attr({'src':result[i]['image']}).appendTo(element);
							                        				  $('#preview').html(element);
							                        	    	}
															}
												
			});
		});
		</script>
      <div class="uploadWrapper">
		<form method="post" enctype="multipart/form-data">
		<dl><dt>Name :</dt><dd><input type="text" name="name" /></dd></dl>
		<dl><dt>Email :</dt><dd><input type="text" name="email" /></dd></dl>
		<dl><dt>Upload Single File :</dt><dd><input type="file" name="file[]" id="file"/></dd></dl>
		</form>
	</div>
	<div id="preview"></div>
</div>	
<div class="wrapper">
	  <h3> 2.Multiple file upload</h3>
    <script type="text/javascript">
		$(function() {   
			$('#multiplefile').fileupload('upload.php',{frameId:'multipleUpload',
														multiple:true,
														onComplete : function(result){
															   $('#multiplepreview').html('');
											                 	for(var i=0,len=result.length;i<len;i++){
											         	    		  element = $("<div class='image'>");
											         				  image = $('<img>').attr({'src':result[i]['image']}).appendTo(element);
											         				  $(element).appendTo('#multiplepreview');
											         	    	}
											                 	$('#loader').html('');
														},
											         	 beforeSend : function(){
												         	$('#loader').html('..uploading Image..');
														}
			});
		});
		</script>
		<div class="uploadWrapper">
		<form method="post" enctype="multipart/form-data">
			<dl><dt>Upload Multiple files :</dt><dd><input type="file" name="file[]" id="multiplefile"/></dd>
			<div id='loader'></div>
			</dl>
		</form>
		</div>	
		<div id="multiplepreview"></div>
</div>	

<div class="wrapper">
	  <h3> 3.Use single browse button to upload multiple files </h3>
	  <h4>This allow user to upload multiple files by clicking single button multiple times</h4>
    <script type="text/javascript">
		$(function() {   
			$('#singleMultiple').fileupload('upload.php',{frameId:'singleMultipleFrame',
														  onComplete : function(result){
											                 	for(var i=0,len=result.length;i<len;i++){
											         	    		  element = $("<div class='image'>");
											         				  image = $('<img>').attr({'src':result[i]['image']}).appendTo(element);
											         				  $(element).appendTo('#singleMultiplePreview');
											         	    	}
											                 	$('#loader').html('');
														},
											         	 beforeSend : false // disable loader 
			});
		});
		</script>
		<div class="uploadWrapper">
		<form method="post" enctype="multipart/form-data">
			<dl><dt>Upload file:</dt><dd><input type="file" name="file[]" id="singleMultiple"/></dd>
			</dl>
		</form>
		</div>	
		<div id="singleMultiplePreview"></div>
</div>
		
	</div>	
	
	</body>
</html>		