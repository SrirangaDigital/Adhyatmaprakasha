<?php include(__DIR__ . "/../inc/include_header.php");?>

	<div class="content">
		<div class="colnav">
				<p>
					<br /><br />
					<span class="lang1"><a href="kannada_books.php">Kannada</a></span><br /><br />
					<span class="lang1"><a href="sanskrit_books.php">Sanskrit</a></span><br /><br />
					<span class="lang1"><a href="english_books.php">English</a></span><br /><br />
				<span class="lang1"><a href="other_books.php">Other</a></span><br /><br />
			</p>
				</p>
		</div>
		<div class="colmiddle">
            <div class="archive_holder">
                <div class="page_title">Other Books</div>
                
<?php
include(__DIR__ . "/../inc/connect.php");

//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
//~ $rs = mysql_select_db($database,$db) or die("No Database");

$db = @new mysqli('localhost', "$user", "$password", "$database");
mysqli_set_charset ( $db , "utf8" );
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

$query = "select * from other_books_list order by title";

//~ $result = mysql_query($query);
//~ $num_rows = mysql_num_rows($result);

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

$stack = array();
$p_stack = array();
$first = 1;

$li_id = 0;
$ul_id = 0;

$plus_link = "<img class=\"bpointer\" title=\"Expand\" src=\"images/plus.gif\" alt=\"Expand or Collapse\" onclick=\"display_block(this)\" />";
//$plus_link = "<a href=\"#\" onclick=\"display_block(this)\"><img src=\"plus.gif\" alt=\"\"></a>";
$bullet = "<img class=\"bpointer\" src=\"images/bullet_1.gif\" alt=\"Point\" />";
$month_name = array("0"=>"","1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

if($num_rows > 0)
{
	echo "<div class=\"treeview\">";
	for($i=1;$i<=$num_rows;$i++)
	{
		//~ $row=mysql_fetch_assoc($result);
		$row = $result->fetch_assoc();
		
		$book_id = $row['book_id'];
		$level = $row['level'];
		$title = $row['title'];
		$authid = $row['authid'];
		$authorname = $row['authorname'];
		$page = $row['page'];
		$page_end = $row['page_end'];
		$edition = $row['edition'];
		$volume = $row['volume'];
		$part = $row['part'];
		$type = $row['type'];
		$year = $row['year'];
		$month = $row['month'];
		$nodata = '';
		if(!file_exists("../Volumes/other_books/djvu/". $book_id ."/shared_anno.iff"))
		{
			//continue;
		}
		
		if($authid != 0)
		{
			$disp_author =  "<span class=\"authorspan\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&mdash;</span>";
			$aut = preg_split('/;/',$authid);

			$fl = 0;
			foreach ($aut as $aid)
			{
				$query2 = "select * from author_other where authid=$aid";
				
				//~ $result2 = mysql_query($query2);
				//~ $num_rows2 = mysql_num_rows($result2);
				
				$result2 = $db->query($query2); 
				$num_rows2 = $result2 ? $result2->num_rows : 0;

				if($num_rows2 > 0)
				{
					//~ $row2=mysql_fetch_assoc($result2);
					$row2 = $result2->fetch_assoc();

					$authorname=$row2['authorname'];

					if($fl == 0)
					{
						$disp_author = $disp_author . "<span class=\"authorspan\"><a href=\"auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "&amp;type=$type\">$authorname</a></span>";
						$fl = 1;
					}
					else
					{
						$disp_author = $disp_author .  "<span class=\"titlespan\">;&nbsp;</span><span class=\"authorspan\"><a href=\"auth.php?authid=$aid&amp;author=" . urlencode($authorname) ."&amp;type=$type\">$authorname</a></span>";
					}
				}
				if($result2){$result2->free();}
			}
		}

		$book_info = '';
		
		if(isset($row['language']) && $row['language'] != '')
		{
			$book_info = $row['language'];
		}
		if($edition != '00')
		{
            $edition_name = array("1"=>"First","2"=>"Second","3"=>"Third","4"=>"Fourth","5"=>"Fifth");

			$book_info = $book_info . $edition_name[intval($edition)] . "&nbsp;Edition";
		}
		if($volume != '00')
		{
			$book_info = $book_info . " | Volume " . intval($volume);
		}
		if($part != '00')
		{
			$book_info = $book_info . " | Part " . intval($part);
		}
		if(intval($page) != 0)
		{
			$book_info = $book_info . " | pp " . intval($page) . " - " . intval($page_end);	
		}
        if(intval($year) != 0)
		{
			$book_info = $book_info . " | " . $month_name[intval($month)] . " " . intval($year);
		}
		
		$book_info = preg_replace("/^ /", "", $book_info);
		$book_info = preg_replace("/^\|/", "", $book_info);
		$book_info = preg_replace("/^ /", "", $book_info);
			
		if($page != 0)
		{
			if($authid != 0)
			{
				$title = "<span class=\"titlespan\"><a href=\"".$type."_books_toc.php?book_id=$book_id&amp;type=$type&amp;book_title=" . urlencode($title) . "\">$title</a></span><br />" . $disp_author;
			}
			else
			{
				$title = "<span class=\"titlespan\"><a href=\"".$type."_books_toc.php?book_id=$book_id&amp;type=$type&amp;book_title=" . urlencode($title) . "\">$title</a></span>";
			}
			$title = $title . "<br /><span class=\"space_left\"><span class=\"infospan\">$book_info</span></span>";
			if(file_exists("../Volumes/PDF/other/". $book_id ."/index.pdf"))
			{
				$title .= "&nbsp;|&nbsp;<span class=\"downloadpdf\"><a href=\"../Volumes/PDF/other/". $book_id ."/index.pdf\" download=\"". $book_id .".pdf\">Download PDF</a></span>";
			}
		}
		else
		{
			$title = "<span class=\"titlespan\">$title</span>";
			$title = $title . "<br /><span class=\"space_left\"><span class=\"infospan\">$book_info</span></span>";
			if(file_exists("../Volumes/PDF/other/". $book_id ."/index.pdf"))
			{
				$title .= "&nbsp;|&nbsp;<span class=\"downloadpdf\"><a href=\"../Volumes/PDF/other/". $book_id ."/index.pdf\" download=\"". $book_id .".pdf\">Download PDF</a></span>";
			}
        }
				
		$title = preg_replace('/!!(.*)!!/', "<i>$1</i>", $title);
		$title = preg_replace('/---/', "&mdash;", $title);
		$title = preg_replace('/--/', "&ndash;", $title);
		
		if($first)
		{
			array_push($stack,$level);
			$ul_id++;
			echo "<ul id=\"ul_id$ul_id\">\n";
			array_push($p_stack,$ul_id);
			$li_id++;
			$deffer = display_tabs($level) . "<li id=\"li_id$li_id\">:rep:$title";
			$first = 0;
		}
		elseif($level > $stack[sizeof($stack)-1])
		{
			$deffer = preg_replace('/:rep:/',"$plus_link",$deffer);
			echo $deffer;			

			$ul_id++;			
			$li_id++;			
			array_push($stack,$level);
			array_push($p_stack,$ul_id);
			$deffer = "\n" . display_tabs(($level-1)) . "<ul class=\"dnone\" id=\"ul_id$ul_id\">\n";
			$deffer = $deffer . display_tabs($level) ."<li id=\"li_id$li_id\">:rep:$title";
		}
		elseif($level < $stack[sizeof($stack)-1])
		{
			$deffer = preg_replace('/:rep:/',"$bullet",$deffer);
			echo $deffer;
			
			for($k=sizeof($stack)-1;(($k>=0) && ($level != $stack[$k]));$k--)
			{
				echo "</li>\n". display_tabs($level) ."</ul>\n";
				$top = array_pop($stack);
				$top1 = array_pop($p_stack);
			}
			$li_id++;
			$deffer = display_tabs($level) . "</li>\n";
			$deffer = $deffer . display_tabs($level) ."<li id=\"li_id$li_id\">:rep:$title";
		}
		elseif($level == $stack[sizeof($stack)-1])
		{
			$deffer = preg_replace('/:rep:/',"$bullet",$deffer);
			echo $deffer;
			$li_id++;
			$deffer = "</li>\n";
			$deffer = $deffer . display_tabs($level) ."<li id=\"li_id$li_id\">:rep:$title";
		}
	}

	$deffer = preg_replace('/:rep:/',"$bullet",$deffer);
	echo $deffer;

	for($i=0;$i<sizeof($stack);$i++)
	{
		echo "</li>\n". display_tabs($level) ."</ul>\n";
	}

	echo "</div>";
}
else
{
	echo "No data in the database";
}

if($result){$result->free();}
$db->close();

function display_stack($stack)
{
	for($j=0;$j<sizeof($stack);$j++)
	{
		$disp_array = $disp_array . $stack[$j] . ",";
	}
	return $disp_array;
}

function display_tabs($num)
{
	$str_tabs = "";
	
	if($num != 0)
	{
		for($tab=1;$tab<=$num;$tab++)
		{
			$str_tabs = $str_tabs . "\t";
		}
	}
	
	return $str_tabs;
}

?>
            </div>
        </div>
        <?php include(__DIR__ ."/../inc/include_sidebar.php");?>
        <div class="clearfix"></div>
    </div>

<?php include(__DIR__ . "/../inc/include_footer.php");?>
