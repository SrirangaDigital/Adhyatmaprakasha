<?php
	$index = $_GET['index'];
	$lang = $_GET['lang'];
	$volume = $_GET['book_id'];
	$imgurl = $_GET['imgurl'];
	$reduce = round($_GET['level']);
	$book = $_POST['book'];
	$img = preg_split("/\./",$book[$index]);
	$mode = $_GET['mode'];
	//~ header('Content-type: application/json');
	
	if($reduce == 1)
	{
		$pdfurl = "../../../Volumes/PDF/" . $lang . "/" . $volume;
		$imgurl = "../../../Volumes/".$lang."_books/jpg/1/".$volume;
		$dzimgurl = "../../../Volumes/".$lang."_books/jpg/2/".$volume;
		$scale = 2100;
		$djvurl = "../../../Volumes/".$lang."_books/djvu/".$volume;
		$tifurl = "../../../Volumes/".$lang."_books/tif/".$volume;



		
		if(file_exists($pdfurl."/index.pdf")){

			$images = scandir($dzimgurl);
			$jpgimages = [];

			for($i=0;$i<count($images);$i++)
			{
				if($images[$i] != '.' && $images[$i] != '..' && preg_match('/(\.jpg)/' , $images[$i]))
				{
					array_push($jpgimages,$images[$i]);
				}
			}	
			
			$page = $img[0] . ".jpg";
			$arrayIndex = array_search($page,$jpgimages);
			
			$cmd = "convert -density 300 -resize x" . $scale . " " . $pdfurl . "/index.pdf[" . $arrayIndex . "] -alpha remove " . $imgurl . "/". $page;
			exec($cmd);	
		}
		else{	
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
