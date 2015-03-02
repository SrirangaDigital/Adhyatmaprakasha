<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Adhyatma Prakash Karyalaya</title>
<link href="../style/reset.css" media="screen" rel="stylesheet" type="text/css" />
<link href="../style/style.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-2.0.0.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="../js/treeview.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/publication.js"></script>

</head>

<body>
<div class="page">
	<div class="header">
		<div class="logo"><img src="../images/aplogo.png" alt="AP-Logo"/></div>
		<div class="logokalash"><img src="../images/kalash.png" alt="kalash"/></div>
		<div class="title">Adhyātmaprakāsha Kāryālaya</div>
		<div class="subtitle">एतज्ज्ञेयं नित्यमेवात्मसंस्थम् | नातः परं वेदितव्यं हि किञ्चित् ||</div>
		<div id="nav">
			<ul>
				<li><a href="../../index.php">Home</a></li>
				<li><a href="../about.php">About</a></li>
				<li><a href="../activity.php">Activities</a></li>
				<li><a href="../magazine.php">Magazine</a>
					<ul id="magnav">
						<li><a href="../volumes.php">Volumes</a></li>
						<li><a href="../articles.php">Articles</a></li>
						<li><a href="../authors.php">Authors</a></li>
					</ul>
				</li>
				<li><a class="active" href="publications.php">Publications</a>
					<ul id="pubnav">
						<li><a href="../kannada_books.php">Kannada Books</a></li>
						<li><a href="../sanskrit_books.php">Sanskrit Books</a></li>
						<li><a href="../english_books.php">English Books</a></li>
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
				<span class="lang1"><a href="../kannada_books.php">Kannada</a></span><br /><br />
				<span class="lang1"><a href="../sanskrit_books.php">Sanskrit</a></span><br /><br />
				<span class="lang1"><a href="../english_books.php">English</a></span><br /><br />
			</p>
		</div>
		<div class="colmiddle">
            <div class="archive_holder">
<?php
include("../connect.php");
require_once("../common.php");

if(isset($_GET['book_id'])){$book_id = $_GET['book_id'];}else{$book_id = '';}
if(isset($_GET['type'])){$type = $_GET['type'];}else{$type = '';}
if(isset($_GET['book_title'])){$book_title = $_GET['book_title'];}else{$book_title = '';}

$book_title = entityReferenceReplace($book_title);

if(!(isValidId($book_id) && isValidType($type) && isValidTitle($book_title)))
{
	echo "Invalid URL";
	echo "</div></div>";
	include("include_footer.php");
	echo "<div class=\"clearfix\"></div></div>";
	include("include_footer_out.php");
	echo "</body></html>";
	exit(1);
}

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
//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
//~ $rs = mysql_select_db($database,$db) or die("No Database");

$query = "select * from sanskrit_book_toc where book_id='$book_id' and type='$type' order by slno";

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

//~ 
//~ $result = mysql_query($query);
//~ $num_rows = mysql_num_rows($result);

$stack = array();
$p_stack = array();
$first = 1;

$li_id = 0;
$ul_id = 0;

$plus_link = "<img class=\"bpointer\" title=\"Expand\" src=\"../images/plus.gif\" alt=\"Expand or Collapse\" onclick=\"display_block_inside(this)\" />";
//$plus_link = "<a href=\"#\" onclick=\"display_block(this)\"><img src=\"plus.gif\" alt=\"\"></a>";
$bullet = "<img class=\"bpointer\" src=\"../images/bullet_1.gif\" alt=\"Point\" />";

$month_name = array("0"=>"","1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

//~ $plus_link = "+";
//~ $bullet = ".";

$query_aux = "select * from sanskrit_books_list where book_id='$book_id' and type='sanskrit'";

$result_aux = $db->query($query_aux); 
$num_rows_aux = $result_aux ? $result_aux->num_rows : 0;

//~ $result_aux = mysql_query($query_aux);
//~ $num_rows_aux = mysql_num_rows($result_aux);

$row_aux = $result_aux->fetch_assoc();
//~ $row_aux=mysql_fetch_assoc($result_aux);

$edition = $row_aux['edition'];
$volume = $row_aux['volume'];
$part = $row_aux['part'];
$authorname = $row_aux['authorname'];
$page = $row_aux['page'];
$page_end = $row_aux['page_end'];
$type = $row_aux['type'];
$year = $row_aux['year'];
$month = $row_aux['month'];

if($result_aux){$result_aux->free();}

$anames = preg_replace("/;/", ",&nbsp;&nbsp;", $authorname);
$anames = preg_split("/;/", $authorname);

$daname = '';

if(sizeof($anames) > 1)
{
	for($i=0; $i<(sizeof($anames) - 1); $i++)
	{
		$daname = $daname . ",&nbsp;&nbsp;" . $anames[$i];
	}
	$daname = preg_replace("/^,&nbsp;&nbsp;/", "", $daname);
	$daname = $daname . "&nbsp;&nbsp;and&nbsp;&nbsp;" . $anames[sizeof($anames) - 1];
}
else
{
	$daname = $authorname;
}

/*
echo "<div class=\"book_cover\"><img src=\"../images/cover.png\" alt=\"Book Cover\" /></div>";
*/
echo "<div class=\"page_booktitle\">$book_title</div>";
echo "<div class=\"page_subtitle\"><span class=\"itl\">$daname</span></div>";
echo "<div class=\"page_other\">";

$book_info = '';
		
if($edition != '00')
{
	$book_info = $book_info . "संस्करण " . intval($edition);
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
	$book_info = $book_info . " | " . $month_name{intval($month)} . " " . intval($year);
}

$book_info = preg_replace("/^ /", "", $book_info);
$book_info = preg_replace("/^\|/", "", $book_info);
$book_info = preg_replace("/^ /", "", $book_info);

echo "$book_info</div>";
if($num_rows > 0)
{
	echo "<div class=\"treeview\">";
	for($i=1;$i<=$num_rows;$i++)
	{
		//~ $row=mysql_fetch_assoc($result);
		$row = $result->fetch_assoc();
		
		$level = $row['level'];
		$title = $row['title'];
		$page = $row['page'];
		$type = $row['type'];
		$slno = $row['slno'];
		
		$title = "<span class=\"sub_titlespan\"><a href=\"../bookReader.php?book_id=$book_id&amp;page=$page&amp;type=$type\">$title</a></span>";
		$title = preg_replace('/!!(.*)!!/', "<i>$1</i>", $title);
		if($first)
		{
			array_push($stack,$level);
			$ul_id++;
			echo "<ul id=\"ul_id$ul_id\">\n";
			array_push($p_stack,$ul_id);
			$li_id++;
			//echo "<li>$title(" . $stack[sizeof($stack)-1] . ")\n";
			//echo "<li>$title\n";
			$deffer = display_tabs($level) . "<li id=\"li_id$li_id\">:rep:$title";
			$first = 0;
		}
		elseif($level > $stack[sizeof($stack)-1])
		{
			//$parent_id = "ul_id" . $p_stack[sizeof($p_stack)-1];
			//$alt_link = $plus_link;
			//$alt_link = preg_replace('/#/',"#$parent_id",$alt_link);
			$deffer = preg_replace('/:rep:/',"$plus_link",$deffer);
			echo $deffer;			

			$ul_id++;			
			$li_id++;			
			array_push($stack,$level);
			array_push($p_stack,$ul_id);
			//echo "<ul>\n\t<li>$title(" . display_stack($stack) . ")\n";
			//echo "<ul>\n\t<li>$title\n";
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
			//echo "</li>\n<li>$title(" . display_stack($stack) . ")\n";
			$deffer = display_tabs($level) . "</li>\n";
			$deffer = $deffer . display_tabs($level) ."<li id=\"li_id$li_id\">:rep:$title";
		}
		elseif($level == $stack[sizeof($stack)-1])
		{
			$deffer = preg_replace('/:rep:/',"$bullet",$deffer);
			echo $deffer;
			$li_id++;
			//echo "</li>\n<li>$title(" . display_stack($stack) . ")\n";
			//echo "</li>\n<li>$title\n";
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
        <?php include("../include_footer.php");?>
        <div class="clearfix"></div>
    </div>
    <?php include("include_footer_out.php");?>
</div>
</body>
</html>
