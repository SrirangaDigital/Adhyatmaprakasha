<?php
				include("connect.php");
				$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
				$rs = mysql_select_db($database,$db) or die("No Database");
				$query = "select * from top where language='english' order by hits DESC limit 3";
				$result = mysql_query($query);
				echo("\n<span class=\"lang\"><a href=\"english_books.html\">English</a></span><br />\n");
				$num_rows = mysql_num_rows($result);
				if($num_rows)
				{
					for($i=1;$i<=$num_rows;$i++)
					{
						$row=mysql_fetch_assoc($result);
						$bookid = $row['bookid'];
						$hits = $row['hits'];
						$query1 = "select * from books where bookid = $bookid";
						$result1 = mysql_query($query1);
						$row1=mysql_fetch_assoc($result1);
						$title = $row1['title'];
						$lang= $row1['language'];
						$bcode = $row1['bcode'];
						echo ("<span class=\"news\"><a href=\"openbook.php?bcode=$bcode&lang=$lang\" target=\"_blank\">$title</a></span><br />\n");
					}
				}
				
				$query = "select * from top where language='kannada' order by hits DESC limit 3";
				$result = mysql_query($query);
				echo("\n<br /><span class=\"lang\"><a href=\"kannada_books.html\">ಕನ್ನಡ</a></span><br />\n");
				$num_rows = mysql_num_rows($result);
				if($num_rows)
				{
					for($i=1;$i<=$num_rows;$i++)
					{
						$row=mysql_fetch_assoc($result);
						$bookid = $row['bookid'];
						$hits = $row['hits'];
						$query1 = "select * from books where bookid = $bookid";
						$result1 = mysql_query($query1);
						$row1=mysql_fetch_assoc($result1);
						$title = $row1['title'];
						$lang= $row1['language'];
						$bcode = $row1['bcode'];
						echo ("<span class=\"news\"><a href=\"openbook.php?bcode=$bcode&lang=$lang\" target=\"_blank\">$title</a></span><br />\n");
					}
				}
				
				$query = "select * from top where language='sanskrit' order by hits DESC limit 3";
				$result = mysql_query($query);
				echo("\n<br /><span class=\"lang\"><a href=\"sanskrit_books.html\">संस्कृतम् </a></span><br />\n");
				$num_rows = mysql_num_rows($result);
				if($num_rows)
				{
					for($i=1;$i<=$num_rows;$i++)
					{
						$row=mysql_fetch_assoc($result);
						$bookid = $row['bookid'];
						$hits = $row['hits'];
						$query1 = "select * from books where bookid = $bookid";
						$result1 = mysql_query($query1);
						$row1=mysql_fetch_assoc($result1);
						$title = $row1['title'];
						$lang= $row1['language'];
						$bcode = $row1['bcode'];
						echo ("<span class=\"news\"><a href=\"openbook.php?bcode=$bcode&lang=$lang\" target=\"_blank\">$title</a></span><br />\n");
					}
				}
?>
