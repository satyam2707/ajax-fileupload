<?php
error_reporting(0);
$response = array();
$i=0;
define('UPLOAD','upload');
if(!is_dir(UPLOAD))
{
	mkdir(UPLOAD,777);
}
$i=0;
$files = $_FILES['file'];
foreach($files['name'] as $file)
{
	$fileName = md5(uniqid()).'.'.pathinfo($file,PATHINFO_EXTENSION); 
	$destination = UPLOAD.'/'.$fileName;
	if(move_uploaded_file($files['tmp_name'][$i],$destination))
	{
		$thumb = createThumbnail($destination,120);
		//$response[] = array('name'=>$destination,'size'=>$files['size'][$i]);
		$image = "<img src='".$destination."' width=100>";
		$response[] = array('image'=>$thumb,'size'=>$files['size'][$i]);
	}
	$i++;
}

echo json_encode($response);

function createThumbnail($source,$size)
{
	    $img = imagecreatefromjpeg($source);
	    $width = imagesx($img);
        $height = imagesy($img);

        $new_width = $size;
        $new_height = floor($height *($size/$width));

        $tmp_img = imagecreatetruecolor( $new_width, $new_height );
        imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      
		$thumb = UPLOAD.'/thumb_'. pathinfo($source,PATHINFO_BASENAME);
        imagejpeg($tmp_img,$thumb);
		return $thumb;
}
?>
