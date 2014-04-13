<?php

if(isset($file))
{
 	if(file_exists($file))
	{
		header("Cache-control: No-cache");
		header("Pragma: No-cache");
		header("Content-Type: image/jpeg");
		readfile($file);
		exit;
	}
}

?>