<?php
	$index = $_GET['index'];
	$lang = $_GET['lang'];
	$volume = $_GET['volume'];
	$reduce = round($_GET['level']);
	$book = $_POST['book'];
	$imgurl = "../jpg/2/".$lang."/".$volume;
	$img = split("\.",$book[$index]);
	
	if($reduce == 1)
	{
		echo "SUERE";
		exec("php remove.php");
		$imgurl = "../jpg/1/".$lang."/".$volume;
		$scale = 2100;
		$djvurl = "../Volumes/".$lang."/".$volume;
		$tifurl = "../tif/".$lang."/".$volume;
		
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
		
		$rmFile = fopen("remove.php", "w") or die("Unable to open file!");
		$cmd = "rm ".$imgurl."/".$img[0].".jpg";
		fwrite($rmFile , "<?php ");
		fwrite($rmFile , "\n\texec(\"");
		fwrite($rmFile, $cmd);
		fwrite($rmFile , "\");\n");
		$cmd = "rm ".$tifurl."/".$img[0].".tif";
		fwrite($rmFile , "\texec(\"");
		fwrite($rmFile, $cmd);
		fwrite($rmFile , "\");");
		fwrite($rmFile , "\n?>");
		fclose($rmFile);
	}
	$array['id'] = "#pagediv".$index;
	$array['img'] = $imgurl."/".$img[0].".jpg";
	echo json_encode($array);
	
	//~ Update manifest file to download the request file.
	$myfile = fopen("appcache.manifest", "w") or die("Unable to open file!");
	fwrite($myfile,"CACHE MANIFEST\n");
	fwrite($myfile,$imgurl."/".$img[0].".jpg");
	fwrite($myfile,"\n\nNETWORK:\n*\n");
	fwrite($myfile,"FALLBACK:\n");
	fclose($myfile);
?>
