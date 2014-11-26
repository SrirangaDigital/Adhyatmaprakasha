<?php
	$bcode = $_GET['bcode'];
	$lang = $_GET['lang'];
	include("connect.php");
	$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");

	$update_query = "update books set hits=hits+1 where bcode='$bcode'";
	$result = mysql_query($update_query);

	$select_query = "select * from books where bcode='$bcode'";
	$query_result = mysql_query($select_query);
	$num_results = mysql_num_rows($query_result);
	if($num_results)
	{
		$row = mysql_fetch_assoc($query_result);
		$bookid = $row['bookid']; 
		$hits = 1;
		$hh = Date('Y-m-d');

		$query3 = "select * from topviewed where bookid='$bookid' and viewed_date='$hh'";
		$result3 = mysql_query($query3);
		$num_results3 = mysql_num_rows($result3);
		if($num_results3>=1)
		{
			$row = mysql_fetch_assoc($result3);
			$hits = $row['hits'];
			$serial = $row['serial'];
			$query11 = "update topviewed set hits=hits+1 where bookid=$bookid and viewed_date='$hh'";
			$result11 = mysql_query($query11);
		}
		else
		{
			$query1 = "insert into topviewed values('','$bookid','$lang','$hits','$hh')";
			$result1 = mysql_query($query1);
		}
		
		//to top table...
		$query = "select distinct bookid from topviewed order by bookid";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		if($num_rows)
		{
			for($i=1;$i<=$num_rows;$i++)
			{	
				$row=mysql_fetch_assoc($result);
				$bookid = $row['bookid'];
				$bookarray[] = $bookid;
			}
		}
		$arraysize= count($bookarray);
	//	sort($bookarray);
	//	print_r($bookarray);
		for($i=0;$i<$arraysize;$i++)
		{
			$hh = Date('Y-m-d');
			list($year,$month,$day) = explode("-",$hh);
			$oldmonth = $month - 1;
			$oldyear = $year - 1;
			if($oldmonth<10){ $oldmonth = "0"."$oldmonth";}
			if($month==1){ $year = $year - 1;}
			$date1 = "$year"."-"."$oldmonth"."-"."$day";
			$date2 = $hh;
			
	//		echo "bookid = $bookarray[$i]<br />";
			$query1 = "select sum(hits) from topviewed where bookid=$bookarray[$i] and viewed_date between '$date1' and '$date2'";
			$result1 = mysql_query($query1);
			$num_rows1 = mysql_num_rows($result1);
			if($num_rows1)
			{
				for($i1=1;$i1<=$num_rows1;$i1++)
				{
					$row1=mysql_fetch_assoc($result1);
					$sumhits = $row1['sum(hits)'];
				//	echo "sumofhits = $sumhits---- bookid = $bookarray[$i]------";
					
					$query11 = "select language from topviewed where bookid=$bookarray[$i]";
					$result11 = mysql_query($query11);
					$num_rows11 = mysql_num_rows($result11);
					$row11=mysql_fetch_assoc($result11);
					$language = $row11['language'];
					
				//	echo "$language-----\n";
					$query34 = "select * from top where bookid='$bookarray[$i]'";
					$result34 = mysql_query($query34);
					$num_results34 = mysql_num_rows($result34);
					
					if($num_results34)
					{
				//		echo "-----updating----\n";
						$query4	= "update top set hits='$sumhits',language='$language' where bookid = $bookarray[$i]";
				//		echo "$query4<br />\n";
						$result4 = mysql_query($query4);
					}
					else
					{
					//	echo "-----inserting<br />\n";
						$query4	= "insert into top values('$bookarray[$i]','$language','$sumhits')";
						$result4 = mysql_query($query4);
					}
				}
			}
		}
		@header("Location:../Books/$lang/$bcode/$bcode.djvu?djvuopts&zoom=page");
	}
	else
	{
		echo "No Results:\n";
		exit(0);
	}
?>
