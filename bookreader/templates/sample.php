<?php
	$array = $_POST['indicesToDisplay'];
	$array2 = $_POST['book'];
	$myfile = fopen("manifest.appcache", "w") or die("Unable to open file!");
	fwrite($myfile,"CACHE MANIFEST\n");
	fwrite($myfile,"../img/2/".$array2[1]);
	fclose($myfile);
?>
