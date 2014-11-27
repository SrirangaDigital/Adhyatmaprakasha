<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Adhyatma Prakash Karyalaya</title>
<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />
<link href="style/style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="page">
	<div class="header">
		<div class="logo"><img src="images/aplogo.png" alt="AP-Logo"/></div>
		<div class="logokalash"><img src="images/kalash.png" alt="kalash"/></div>
		<div class="title">Adhyātmaprakāsha Kāryālaya</div>
		<div class="subtitle">एतज्ज्ञेयं नित्यमेवात्मसंस्थम् | नातः परं वेदितव्यं हि किञ्चित् ||</div>
		<div id="nav">
			<ul>
				<li><a href="../index.php">Home</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="activity.php">Activities</a></li>
				<li><a href="magazine.php">Magazine</a>
					<ul id="magnav">
						<li><a href="volumes.php">Volumes</a></li>
						<li><a href="articles.php?letter= ">Articles</a></li>
						<li><a href="authors.php?letter= ">Authors</a></li>
					</ul>
				</li>
				<li><a class="active" href="publications.php">Publications</a>
					<ul id="pubnav">
						<li><a href="kannada_books.php">Kannada Books</a></li>
						<li><a href="sanskrit_books.php">Sanskrit Books</a></li>
						<li><a href="#">English Books</a></li>
					</ul>
				</li>
				<li><a href="appeal.php">Appeal</a></li>
				<li><a href="news.php">News</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div>
	</div>
	<div class="content">
		<div class="colnav">
				<p>
					<br /><br />
					<span class="lang1"><a href="kannada_books.php">Kannada</a></span><br /><br />
					<span class="lang1"><a href="sanskrit_books.php">Sanskrit</a></span><br /><br />
					<span class="lang1"><a href="english_books.php">English</a></span><br /><br />
				</p>
		</div>
		<div class="colmiddlekannada">
            <div class="archive_holder">
<?php
include("connect.php");

//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
//~ $rs = mysql_select_db($database,$db) or die("No Database");

$db = @new mysqli('localhost', "$user", "$password", "$database");
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

$query = "select * from english_books_list order by slno";

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

		if($authid != 0)
		{
			$disp_author =  "<span class=\"authorspan\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&mdash;</span>";
			$aut = preg_split('/;/',$authid);

			$fl = 0;
			foreach ($aut as $aid)
			{
				$query2 = "select * from author_english where authid=$aid";
				
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
						$disp_author = $disp_author . "<span class=\"authorspan\"><a href=\"auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
						$fl = 1;
					}
					else
					{
						$disp_author = $disp_author .  "<span class=\"titlespan\">;&nbsp;</span><span class=\"authorspan\"><a href=\"auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
					}
				}
				if($result2){$result2->free();}
			}
		}

		$book_info = '';
		
		if($edition != '00')
		{
			if (intval($edition) == 1)
			{
				$book_info = $book_info . "First Edition";
			}
			if (intval($edition) == 2)
			{
				$book_info = $book_info . "Second Edition";
			}
			if (intval($edition) == 3)
			{
				$book_info = $book_info . "Third Edition";
			}
			if (intval($edition) == 4)
			{
				$book_info = $book_info . "Fourth Edition";
			}
			if (intval($edition) == 5)
			{
				$book_info = $book_info . "Fifth Edition";
			}
			if (intval($edition) == 6)
			{
				$book_info = $book_info . "Sixth Edition";
			}
			if (intval($edition) == 7)
			{
				$book_info = $book_info . "Seventh Edition";
			}
			if (intval($edition) == 9)
			{
				$book_info = $book_info . "Ninth Edition";
			}
			if (intval($edition) == 10)
			{
				$book_info = $book_info . "Tenth Edition";
			}
			if (intval($edition) == 19)
			{
				$book_info = $book_info . "Ninteenth Edition";
			}
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
		
		$book_info = preg_replace("/^ /", "", $book_info);
		$book_info = preg_replace("/^\|/", "", $book_info);
		$book_info = preg_replace("/^ /", "", $book_info);
			
		if($page != 0)
		{
			if($authid != 0)
			{
				$title = "<span class=\"titlespan\"><a href=\"".$type."/".$type."_books_toc.php?book_id=$book_id&amp;type=$type&amp;book_title=" . urlencode($title) . "\">$title</a></span><br />" . $disp_author;
			}
			else
			{
				$title = "<span class=\"titlespan\"><a href=\"".$type."/".$type."_books_toc.php?book_id=$book_id&amp;type=$type&amp;book_title=" . urlencode($title) . "\">$title</a></span>";
			}
			$title = $title . "<br /><span class=\"space_left\"><span class=\"infospan\">$book_info</span></span>";
		}
		else
		{
			$title = "<span class=\"titlespan\">$title</span>";
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

?>         </div>     
        </div>
	<div class="col2">
			<div class="widget">
				<div class="title">News updates</div>
				<p>
					<span class="news"><a href="circulars/intro.php" target="_blank">ಶ್ರೀ ಸಚ್ಚಿದಾನಂದ ಅಧ್ಯಾತ್ಮವಿದ್ಯಾಲಯ - ಪರಿಚಯ ಪತ್ರ ಮತ್ತು ಪಾಠಕ್ರಮ</a></span>
				</p>
			</div>
			<div class="rule"></div>
			<div class="widget">
				<div class="title">Top viewed books</div>
				<p>
<span class="lang"><a href="english_books.html">English</a></span><br />
<span class="news"><a href="../Books/english/es1/es1.djvu?djvuopts&zoom=page" target="_blank">DakṣiṇaBhārata - ŚāṅkaraVedānta-VidvadGoṣṭhi (Commemoration Volume) - (दक्षिणभारत - शाङ्करवेदान्त -विद्वद्गोष्ठी (स्मरणसञ्चिका))</a></span><br />
<span class="news"><a href="../Books/english/e1/e1.djvu?djvuopts&zoom=page" target="_blank">Nārada's Aphorisms on Bhakti</a></span><br />
<span class="news"><a href="../Books/english/e9/e9.djvu?djvuopts&zoom=page" target="_blank">Intuition of Reality</a></span><br />

<br /><span class="lang"><a href="kannada_books.html">ಕನ್ನಡ</a></span><br />
<span class="news"><a href="openbook.php?bcode=k1&lang=kannada" target="_blank">ಅಧ್ಯಾತ್ಮವೆಂದರೇನು? (ಅಧ್ಯಾತ್ಮ - ಎಂಬ ಮಾತಿನ ವಿವರಣೆ)</a></span><br />
<span class="news"><a href="openbook.php?bcode=k146&lang=kannada" target="_blank">ಸಂಸ್ಕತಪ್ರಥಮಪುಸ್ತಕಮ್</a></span><br />
<span class="news"><a href="openbook.php?bcode=k82&lang=kannada" target="_blank">ಈಶಾವಾಸ್ಯೋಪನಿಷದ್ಭಾಷ್ಯ (ಮೂಲ, ಅನುವಾದ, ಟಿಪ್ಪಣಿ, ಪೀಠಿಕೆ)</a></span><br />

<br /><span class="lang"><a href="sanskrit_books.html">संस्कृतम् </a></span><br />
<span class="news"><a href="openbook.php?bcode=&lang=kannada" target="_blank">ಸರ್ವವೇದಾಂತ ಸಿದ್ಧಾಂತ ವ್ಯಾಸಂಗ</a></span><br />
<span class="news"><a href="openbook.php?bcode=s1&lang=sanskrit" target="_blank">ईशावास्योपनिशत् (सभाष्याः)</a></span><br />
<span class="news"><a href="openbook.php?bcode=s28&lang=sanskrit" target="_blank">भक्तिचन्द्रिका</a></span><br />
</p>
</div>
		</div>
	</div>
	<div class="footer">
		<div class="foot_box">
			<div class="fleft">
				&copy;2007-2011 Adhyatmaprakasha Karyalaya, Holenarsipura. All Rights Reserved
			</div>
			<div class="fright">
				<ul>
					<li><a href="#">Terms of Use</a></li>
					<li>|</li>
					<li><a href="#">Privacy Policy</a></li>
					<li>|</li>
					<li><a href="php/contact.php">Contact Us</a></li>
					<li>&nbsp;</li>
				</ul>
			</div>
		</div>
	</div>
</div>
</body>
</html>
