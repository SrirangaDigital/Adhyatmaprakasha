<?php
	$index = $_GET['index'];
	$lang = $_GET['lang'];
	$volume = $_GET['volume'];
	$imgurl = $_GET['imgurl'];
	$reduce = round($_GET['level']);
	$book = $_POST['book'];
	$imgurl = $imgurl."2/".$volume;
	$img = split("\.",$book[$index]);
	//~ header('Content-type: application/json');
	
	if($reduce == 1)
	{
		$imgurl = "../../../Volumes/jpg/".$lang."/1/".$volume;
		$scale = 2100;
		$djvurl = "../../../Volumes/djvu/".$lang."/".$volume;
		$tifurl = "../../../Volumes/tif/".$lang."/".$volume;
		
		if(!file_exists($tifurl."/".$img[0].".tif"))
		{
			$cmd = "ddjvu -format=tif ".$djvurl."/".$img[0].".djvu ".$tifurl."/".$img[0].".tif";
			exec($cmd);
		}
		if(!file_exists($imgurl."/".$img[0].".jpg"))
		{
			$cmd="convert $tifurl/".$img[0].".tif -resize x".$scale." $imgurl/".$img[0].".jpg";
			echo "sureshshshshsh".$cmd."\n";
			exec($cmd);
		}
		
	}
	$array['id'] = "#pagediv".$index;
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
