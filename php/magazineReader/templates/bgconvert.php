<?php
	$index = $_GET['index'];
	$issue = $_GET['issue'];
	$lang = $_GET['lang'];
	$volume = $_GET['volume'];
	$imgurl = $_GET['imgurl'];
	$reduce = round($_GET['level']);
	$book = $_POST['book'];
	$img = preg_split("/\./",$book[$index]);
	$mode = $_GET['mode'];
	//~ header('Content-type: application/json');
	
	if($reduce == 1)
	{
		$imgurl = "../../../Volumes/".$lang."/jpg/1/".$volume."/".$issue;
		$scale = 2100;
		$djvurl = "../../../Volumes/".$lang."/djvu/".$volume."/".$issue;
		$tifurl = "../../../Volumes/".$lang."/tif/".$volume."/".$issue;
		
		
		if(!file_exists($tifurl."/".$img[0].".tif"))
		{
			$cmd = "ddjvu -format=tif ".$djvurl."/".$img[0].".djvu ".$tifurl."/".$img[0].".tif";
			exec($cmd);
		}
		if(!file_exists($imgurl."/".$img[0].".jpg"))
		{
			$cmd="convert $tifurl/".$img[0].".tif -resize x".$scale." $imgurl/".$img[0].".jpg";
			exec($cmd);
		}
		
	}
	$array['id'] = "#pagediv".$index;
	$array['mode'] = $mode;
	$array['img'] = $imgurl."/".$img[0].".jpg";
	
	echo json_encode($array);
	//~ Update manifest file to download the request file.
	$myfile = fopen("appcache.manifest", "w") or die("Unable to open file!!!");
	fwrite($myfile,"CACHE MANIFEST\n");
	fwrite($myfile,$imgurl."/".$img[0].".jpg");
	fwrite($myfile,"\n\nNETWORK:\n*\n");
	fwrite($myfile,"FALLBACK:\n");
	fclose($myfile);
?>
