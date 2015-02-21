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
				<li><a class="active" href="magazine.php">Magazine</a>
					<ul id="magnav">
						<li><a href="volumes.php">Volumes</a></li>
						<li><a href="articles.php">Articles</a></li>
						<li><a href="authors.php">Authors</a></li>
					</ul>
				</li>
				<li><a href="publications.php">Publications</a>
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
					<span class="lang1"><a href="volumes.php">Volumes</a></span><br /><br />
					<span class="lang1"><a href="articles.php">Articles</a></span><br /><br />
					<span class="lang1"><a href="authors.php">Authors</a></span><br /><br />
				</p>
        </div>
		<div class="colmiddle">
            <div class="archive_holder">
<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['authid'])){$authid = $_GET['authid'];}else{$authid = '';}
if(isset($_GET['author'])){$authorname = $_GET['author'];}else{$authorname = '';}

$authorname = entityReferenceReplace($authorname);

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


echo "<div class=\"page_title\">$authorname ರವರ ಲೇಖನಗಳು</div>";
echo "<ul class=\"dot\">";

$query = "select * from article where authid like '%$authid%'";

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

		$titleid=$row['titleid'];
        $title=$row['title'];
		$page=$row['page'];
		$authid=$row['authid'];
		$volume=$row['volume'];
		$issue=$row['issue'];
		$year=$row['year'];
		$month=$row['month'];
		echo "<li>";
		echo "<span class=\"sub_titlespan\"><a href=\"magazineReader.php?volume=$volume&amp;issue=$issue&amp;page=$page&amp;year=$year&amp;month=$month\">$title</a></span>";
		echo "
		<span class=\"sub_titlespan\">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
		<span class=\"yearspan\">
			<a href=\"toc.php?vol=$volume&amp;issue=$issue\"><span style=\"font-size: 1.1em;\">ಸಂಪುಟ.</span>&nbsp;".intval($volume)."&nbsp;(<span style=\"font-size: 1.1em;\">ಸಂಚಿಕೆ.</span> ".$issue.")&nbsp;;&nbsp;$month&nbsp;".$year."</a>
		</span>";
        echo "<br /><span class=\"downloadspan\"><a href=\"magazineReader.php?volume=$volume&amp;issue=$issue&amp;page=$page&amp;year=$year&amp;month=$month\">View article</a>&nbsp;|&nbsp;<a href=\"javascript:void(0);\">Download article (DjVu)</a>&nbsp;|&nbsp;<a href=\"javascript:void(0);\">Download article (PDF)</a></span>";
		echo "</li>\n";
	}
}
else
{
	echo "No data in the database";
}
if($result){$result->free();}
$db->close();

echo "</ul>";

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
