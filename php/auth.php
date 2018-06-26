<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/aplogo.ico">
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
						<li><a href="articles.php">Articles</a></li>
						<li><a href="authors.php">Authors</a></li>
					</ul>
				</li>
				<li><a class="active" href="publications.php">Publications</a>
					<ul id="pubnav">
						<li><a href="kannada_books.php">Kannada Books</a></li>
						<li><a href="sanskrit_books.php">Sanskrit Books</a></li>
						<li><a href="english_books.php">English Books</a></li>
						<li><a href="other_books.php">Other Books</a></li>
					</ul>
				</li>
				<li><a href="appeal.php">Appeal</a></li>
				<li><a href="news.php">News</a></li>
				<li><a href="contact.php">Contact</a></li>
				<li><a href="search.php">Search</a></li>
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
				<span class="lang1"><a href="other_books.php">Other</a></span><br /><br />
			</p>
			</p>
		</div>
		<div class="colmiddle">
            <div class="archive_holder">
                
<?php
include("connect.php");
require_once("common.php");

if(isset($_GET['authid'])){$authid = $_GET['authid'];}else{$authid = '';}
if(isset($_GET['author'])){$authorname = $_GET['author'];}else{$authorname = '';}
if(isset($_GET['type'])){$type = $_GET['type'];}else{$type = '';}


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

$month_name = array("0"=>"","1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

if($type == "kannada")
{
    echo "<div class=\"page_title\">$authorname ರಚಿಸಿರುವ ಗ್ರಂಥಗಳು</div>";
    $query = "select * from kannada_books_list where authid = '$authid' and type = 'kannada'";
}
if($type == "sanskrit")
{
    echo "<div class=\"page_title\">$authorname द्वारा लिखित पुस्तकों</div>";
    $query = "select * from sanskrit_books_list where authid like '%$authid%' and authorname = '$authorname' and type = 'sanskrit'";
}
if($type == "english")
{
    echo "<div class=\"page_title\">Books written by $authorname</div>";
    $query = "select * from english_books_list where authid like '%$authid%' and authorname = '$authorname' and type = 'english'";
}
if($type == "other")
{
    echo "<div class=\"page_title\">Books written by $authorname</div>";
    $query = "select * from other_books_list where authid like '%$authid%' and authorname = '$authorname' and type = 'other'";
}

// echo $query;

//~ $result = mysql_query($query);
//~ $num_rows = mysql_num_rows($result);

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;
//~ echo $num_rows;
if($num_rows > 0)
{
    echo "<ul>";

	for($i=1;$i<=$num_rows;$i++)
	{
		//~ $row=mysql_fetch_assoc($result);
		$row = $result->fetch_assoc();

		$book_id=$row['book_id'];
		$type=$row['type'];
		$title=$row['title'];
		$page=$row['page'];
		$page_end=$row['page_end'];
		$authid=$row['authid'];
		$authorname=$row['authorname'];
		$edition=$row['edition'];
		$volume=$row['volume'];
		$part=$row['part'];
		$year=$row['year'];
		$month=$row['month'];
        
		$title = preg_replace('/!!(.*)!!/', "<i>$1</i>", $title);
		$title = preg_replace('/!/', "", $title);
			
			
		$book_info = '';
		if($type == "kannada")
		{
		    if($edition != '00')
		    {
			$edition_name = array("1"=>"ಮೊದಲನೇ","2"=>"ಎರಡನೇ","3"=>"ಮೂರನೇ","4"=>"ನಾಲ್ಕನೇ","5"=>"ಐದನೇ","6"=>"ಆರನೇ","7"=>"ಏಳನೇ","8"=>"ಎಂಟನೇ","9"=>"ಒಂಬತ್ತನೇ","10"=>"ಹತ್ತನೇ","19"=>"ಹತ್ತೊಂಭತ್ತನೇ");
			$book_info = $book_info . $edition_name{intval($edition)} . "&nbsp;ಆವೃತ್ತಿ ";
		    }
		    if($volume != '00')
		    {
			$book_info = $book_info . "  | ಸಂಪುಟ " . intval($volume);
		    }
		    if($part != '00')
		    {
			$book_info = $book_info . "  | ಭಾಗ " . intval($part);
		    }
		    if(intval($page) != 0)
		    {
			$book_info = $book_info . " | pp " . intval($page) . " - " . intval($page_end);
		    }
		}
		if($type == "sanskrit")
		{
		    if($edition != '00')
		    {
			$edition_name = array("1"=>"पहले ","2"=>"दूसरे ","3"=>"तीसरे ","4"=>"चौथे ","5"=>"पांचवें ");
			$book_info = $book_info . $edition_name{intval($edition)} . "&nbsp;संस्करण";
		    }
		    if($volume != '00')
		    {
			$book_info = $book_info . " | Volume " . intval($volume);
		    }
		    if($part != '00')
		    {
			$book_info = $book_info . " | Part " . intval($part) ;
		    }
		    if(intval($page) != 0)
		    {
			$book_info = $book_info . " | pp " . intval($page) . " - " . intval($page_end);
		    }
		}
		if($type == "english")
		{
		    if($edition != '00')
		    {
			$edition_name = array("1"=>"First","2"=>"Second","3"=>"Third","4"=>"Fourth","5"=>"Fifth");
			$book_info = $book_info . $edition_name{intval($edition)} . "&nbsp;Edition";
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
		}
		if($type == "other")
		{
		    if(isset($row['language']) && $row['language'] != '')
		    {
				$book_info = $book_info . $row['language'];
		    }
		    if($edition != '00')
		    {
				$edition_name = array("1"=>"First","2"=>"Second","3"=>"Third","4"=>"Fourth","5"=>"Fifth");
				$book_info = $book_info . $edition_name{intval($edition)} . "&nbsp;Edition";
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
		}

		$book_info = preg_replace("/^ /", "", $book_info);
		$book_info = preg_replace("/^\|/", "", $book_info);
		$book_info = preg_replace("/^ /", "", $book_info);
        
		echo "<li>";
		echo "<span class=\"sub_titlespan\"><a href=\"".$type."/".$type."_books_toc.php?book_id=$book_id&amp;type=$type&amp;book_title=" . urlencode($title) . "\">$title</a></span>";
		echo "<br /><span class=\"bookspan\">$book_info</span>";
		echo "<br /><span class=\"downloadspan\"><a href=\"".$type."/".$type."_books_toc.php?book_id=$book_id&amp;type=$type&amp;book_title=" . urlencode($title) . "\">View TOC</a>&nbsp;|&nbsp;<a target=\"_blank\" href=\"bookReader.php?book_id=$book_id&amp;page=$page&amp;type=$type\">Read Book</a>&nbsp;|&nbsp;<a href=\"../Volumes/PDF/other/". $book_id ."/index.pdf\" download=\"". $book_id .".pdf\">Download PDF</a></span>";
		echo "</li>\n";
	}
    echo "</ul>";
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
