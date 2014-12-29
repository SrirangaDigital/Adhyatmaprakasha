<?php
	$projectId = $_GET["projectId"];
	$qtext = $_GET["q"];
	$dc = mysql_connect("localhost", "root" , "mysql") or die("Not Connected to db");
	$db = mysql_select_db("kscst1" , $dc) or die("Not selected DB");
	
	$sd["q"] = $qtext;
	$sd["indexed"] = true;
	$j = 0;
	$query = "select * from searchtable where text regexp '$qtext' and cur_page NOT REGEXP '[a-z]' and projectid = '$projectId'";
	
	$sd["matches"]="";
	$array ="";
	$result = mysql_query($query) or die ("query failed".mysql_error());
	
	while($row = mysql_fetch_assoc($result))
	{
		$query1 = "select * from word where word regexp '$qtext' and pagenum = ".$row["cur_page"];
		$result1 = mysql_query($query1);
		$cord = array();
		$array = "";
		$row["text"] = txtTrimer($row["text"] , $qtext);
		while($row1 = mysql_fetch_assoc($result1))
		{
			$sumne = preg_split("/,/", $row1['cords']);
			for($i=0; $i<count($sumne);$i++)
			{
				$sumne[$i] = floor($sumne[$i]/(($row1['width']+$row1['height'])/2010));
			}
			$cord[] = array("l" => $sumne[0],"b" => $sumne[1],"r" => $sumne[2],"t" => $sumne[3]);
		}
		$array["text"] = $row["text"];
		$array["par"][] = array( "page" => $row["cur_page"] , "boxes" => $cord);
		$sd["matches"][] = $array;
	}
	echo json_encode($sd);
	
	function txtTrimer($text , $qtext){
		//~ return 200 character from $row["text"]
		$pos = stripos($text ,  $qtext);
		($pos - 75 ) < 0 ? $start = 0 : $start = $pos - 75; $end = 200;
		$text = substr($text ,$start , $end);
		$text = preg_replace("/$qtext/i" , "{{{".$qtext."}}}" , $text); 
		return $text;
	}
?>
