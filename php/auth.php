<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Adhyatma Prakash Karyalaya</title>
<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />
<link href="style/style.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-2.0.0.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/treeview.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/publication.js"></script>

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
						<li><a href="english_books.php">English Books</a></li>
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
require_once("common.php");

if(isset($_GET['authid'])){$authid = $_GET['authid'];}else{$authid = '';}
if(isset($_GET['author'])){$authorname = $_GET['author'];}else{$authorname = '';}


if(!(isValidAuthid($authid) && isValidAuthor($authorname)))
{
	echo "Invalid URL";
	
	echo "</div></div>";
	include("include_footer.php");
	echo "<div class=\"clearfix\"></div></div>";
	include("include_footer_out.php");
	echo "</body></html>";
	exit(1);
}

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

$month_name = array("0"=>"","1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

echo "<div class=\"page_title\">Bibliography of $authorname</div>";
echo "<ul>";

$query = "(select type, book_id, title, page from kannada_books_list where authid like '%$authid%' and authorname = '$authorname') 
UNION ALL (select type, book_id, title, page from sanskrit_books_list where authid like '%$authid%' and authorname = '$authorname') 
UNION ALL (select type, book_id, title, page from english_books_list where authid like '%$authid%' and authorname = '$authorname')";

// echo $query;

//~ $result = mysql_query($query);
//~ $num_rows = mysql_num_rows($result);

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	for($i=1;$i<=$num_rows;$i++)
	{
		//~ $row=mysql_fetch_assoc($result);
		$row = $result->fetch_assoc();

		$type=$row['type'];
		$book_id=$row['book_id'];
		$title=$row['title'];
		$page=$row['page'];
		
		$title = preg_replace('/!!(.*)!!/', "<i>$1</i>", $title);
		$title = preg_replace('/!/', "", $title);
		
		if(($type == "kannada") || ($type == "sanskrit") || ($type == "english"))
		{
			if($type == "kannada")
			{
				$query_aux = "select * from kannada_books_list where book_id='$book_id' and type='".$type."'";
			}
			else
			{
				$query_aux = "select * from ".$type."_books_list where book_id='$book_id' and type='".$type."'";
			}
			
			//~ $result_aux = mysql_query($query_aux);
			//~ $num_rows_aux = mysql_num_rows($result_aux);
			
			$result_aux = $db->query($query_aux); 
			$num_rows_aux = $result_aux ? $result_aux->num_rows : 0;

			//~ $row_aux=mysql_fetch_assoc($result_aux);
			$row_aux = $result_aux->fetch_assoc();
			
			$authid=$row_aux['authid'];
			$authorname=$row_aux['authorname'];
			$type=$row_aux['type'];
			$page=$row_aux['page'];
			$page_end=$row_aux['page_end'];
			$edition=$row_aux['edition'];
			$volume=$row_aux['volume'];
			$part=$row_aux['part'];
			$year=$row_aux['year'];
			$month=$row_aux['month'];
			$book_id=$row_aux['book_id'];
			
			if($result_aux){$result_aux->free();}
			
			$book_info = '';
            if($edition != '00')
			{
				if (intval($edition) == 1)
                {
                    $book_info = $book_info . "First Edition |";
                }
                if (intval($edition) == 2)
                {
                    $book_info = $book_info . "Second Edition |";
                }
                if (intval($edition) == 3)
                {
                    $book_info = $book_info . "Third Edition |";
                }
                if (intval($edition) == 4)
                {
                    $book_info = $book_info . "Fourth Edition |";
                }
                if (intval($edition) == 5)
                {
                    $book_info = $book_info . "Fifth Edition |";
                }
                if (intval($edition) == 6)
                {
                    $book_info = $book_info . "Sixth Edition |";
                }
                if (intval($edition) == 7)
                {
                    $book_info = $book_info . "Seventh Edition |";
                }
                if (intval($edition) == 9)
                {
                    $book_info = $book_info . "Ninth Edition |";
                }
                if (intval($edition) == 10)
                {
                    $book_info = $book_info . "Tenth Edition |";
                }
                if (intval($edition) == 19)
                {
                    $book_info = $book_info . "Ninteenth Edition |";
                }
			}
			if($volume != '00')
			{
				$book_info = $book_info . "  Volume " . intval($volume) . " | ";
			}
			if($part != '00')
			{
				$book_info = $book_info . " Part " . intval($part) . " | ";
			}
			if(intval($page) != 0)
			{
				$book_info = $book_info . " pp " . intval($page) . " - " . intval($page_end);	
			}
			
			echo "<li><span class=\"motif ".$type."_motif\"></span>";
			echo "<span class=\"titlespan\"><a href=\"".$type."/".$type."_books_toc.php?book_id=$book_id&amp;type=$type&amp;book_title=" . urlencode($title) . "\">$title</a></span>";
			echo "<br /><span class=\"bookspan\">$book_info</span>";
			echo "<br /><span class=\"downloadspan\"><a href=\"".$type."/".$type."_books_toc.php?book_id=$book_id&amp;type=$type&amp;book_title=" . urlencode($title) . "\">View TOC</a>&nbsp;|&nbsp;<a target=\"_blank\" href=\"../Volumes/$type/$book_id/index.djvu?djvuopts&amp;page=1&amp;zoom=page\">Read Book</a>&nbsp;|&nbsp;<a href=\"\" target=\"_blank\">Download Book (DjVu)</a>&nbsp;|&nbsp;<a href=\"#\">Download Book (PDF)</a></span>";
			echo "</li>\n";
		}
	}
}
else
{
	echo "No data in the database";
}
if($result){$result->free();}
$db->close();
?>               
            </div>
        </div>
        <?php include("include_footer.php");?>
        <div class="clearfix"></div>
    </div>
    <?php include("include_footer_out.php");?>
</div>
</body>
</html>
