<?php
	session_start();
	
	$volume = $_GET["volume"];
	$issue = $_GET["issue"];
	$qtext = $_GET["q"];
	$type = 'magazine';
	$texts = '';
	$texts = preg_split("/ /", $qtext);
	$textFilter = "";
	$searchedPages = array_values(array_unique($_SESSION['sd'][$type.$volume.$issue]));
	
	for($ic=0;$ic<sizeof($texts);$ic++)
	{
		$textFilter .= $texts[$ic] . "* ";
	}
	
	include("../../connect.php");
	$db = @new mysqli('localhost', "$user", "$password", "$database");
	$db->set_charset("utf8");
	if($db->connect_errno > 0)
	{
		echo 'Not connected to the database [' . $db->connect_errno . ']';
		echo "</div></div>";
		include("include_footer.php");
		echo "<div class=\"clearfix\"></div></div>";
		include("include_footer_out.php");
		echo "</body></html>";
		exit(1);
	}
	
	$sd["q"] = $qtext;
	$sd["indexed"] = true;
	$sd["matches"]="";
	$array ="";
	
	for($a=0;$a<count($searchedPages);$a++)
	{
		$query1 = "SELECT * FROM
						(SELECT * FROM
							(SELECT * FROM
								(SELECT * FROM word_magazine WHERE MATCH (word) AGAINST ('$textFilter' IN BOOLEAN MODE)) AS tb1 
							WHERE volume = '$volume') as tb2
						WHERE issue = '$issue') as tb3
					WHERE pagenum = '$searchedPages[$a]'";
		
		$result1 = $db->query($query1) or die("query Failed ".$db->error);
		$num_rows1 = $result1->num_rows;
		$cord = array();
		$array = "";
		
		for($b = 0; $b < $num_rows1; $b++)
		{
			$row1=$result1->fetch_assoc();
			$cord[] = array("l" => $row1['l'],"b" => $row1["b"],"r" => $row1["r"],"t" => $row1["t"]);
		}
		
		$row1["text"] = "Text Found in";
		$qtext = "Text";
		$row1["text"] = preg_replace("/Text/" , "{{{".$qtext."}}}" , $row1["text"]);
		$array["text"] = $row1["text"];
		$array["par"][] = array( "page" => $row1["pagenum"] , "boxes" => $cord);
		$sd["matches"][] = $array;
	}
	echo json_encode($sd);
?>
