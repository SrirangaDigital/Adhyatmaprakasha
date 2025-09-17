<?php include(__DIR__ . "/../inc/include_header.php");?>

	<div class="content">
		<div class="colnav">
            <p>
				<br /><br />
				<span class="lang1"><a href="#">Kannada</a></span><br /><br />
				<span class="lang1"><a href="sanskrit_books.php">Sanskrit</a></span><br /><br />
				<span class="lang1"><a href="english_books.php">English</a></span><br /><br />
				<span class="lang1"><a href="other_books.php">Other</a></span><br /><br />
			</p>
			</p>
		</div>
		<div class="colmiddle">
            <div class="archive_holder">
                <div class="page_title">ಕನ್ನಡ ಪುಸ್ತಕಗಳು</div>
					<div style="text-align: end; margin-bottom: 30px;">
						<form>
							  <input class="titlespan" style="width: 70%; height: 30px;" type="text" id="search-input" name="search-input" placeholder="Type here and press enter to find the title"><br>
						      <input type="hidden" id="language" name="language" value="kannada">
						</form>
					</div>
		            <div id="search-results-holder"></div>                	
                	<div class="books_from_db">
<?php
include(__DIR__ . "/../inc/connect.php");

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

$query = "select * from kannada_book_categories order by cid";

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

$stack = array();
$p_stack = array();
$first = 1;

$li_id = 0;
$ul_id = 0;

$plus_link = "<img class=\"bpointer\" title=\"Expand\" src=\"images/plus.gif\" alt=\"Expand or Collapse\" onclick=\"display_block(this)\" />";
$bullet = "<img class=\"bpointer\" src=\"images/bullet_1.gif\" alt=\"Point\" />";

if($num_rows > 0)
{
	echo "<div class=\"treeview\">";
	while($row = $result->fetch_assoc())
	{
		$cid = $row['cid'];
		$title = $row['title'];
		$query = "select * from kannada_books_list where cid = '$cid' order by slno ";
		$result1 = $db->query($query); 
		
		echo "<ul id=\"ul_id".$ul_id++."\">\n";
		echo "	<li id=\"li_id".$li_id++."\">$plus_link&nbsp;&nbsp;&nbsp;<span class=\"titlespan\">$title</span>";
		echo "		<ul id=\"ul_id".$ul_id++."\" class=\"dnone\">";
		//~ dnone
		while($row1 = $result1->fetch_assoc())
		{
			$authid = $row1['authid'];
			$type = $row1['type'];
			$title = $row1['title'];
			$book_id = $row1['book_id'];
			echo "<li id=\"li_id".$li_id++."\">&nbsp;&nbsp;&nbsp;&nbsp;$bullet";
			echo "<span class=\"titlespan\"><a href=\"".$type."_books_toc.php?book_id=$book_id&amp;type=$type&amp;book_title=" . urlencode($title) . "\">$title</a></span>";
			if($authid != '')
			{
				$authorString = getAuthorDetails($authid,$db,$type);
				echo "<br/>".$authorString;
			}
			if($row1['page'] != 0)
			{
				$bookInfo = getBookInfo($row1);
				echo "<br/><span class=\"space_left infospan\">$bookInfo</span>&nbsp;|&nbsp;<span class=\"downloadpdf\"><a href=\"../Volumes/PDF/kannada/". $book_id ."/index.pdf\" download=\"". $book_id .".pdf\">Download PDF</a></span>";
			}
			
			echo "		</li>";
		}
		echo "		</ul>";
		echo "	</li>";
		echo "</ul>";
	}
	echo "</div>";
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
        </div>
        <?php include(__DIR__ ."/../inc/include_sidebar.php");?>
        <div class="clearfix"></div>
    </div>


<script type="text/javascript" src="js/jquery-2.0.0.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/treeview.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/publication.js"></script>


<?php include(__DIR__ ."/../inc/include_footer.php");?>


<?php
function display_stack($stack)
{
	for($j=0;$j<sizeof($stack);$j++)
	{
		$disp_array = $disp_array . $stack[$j] . ",";
	}
	return $disp_array;
}

function getAuthorDetails($authid,$db,$type)
{
	
	$disp_author = "";
	if($authid != '')
	{
		$disp_author =  "<span class=\"authorspan\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&mdash;</span>";
		$aut = preg_split('/;/',$authid);
		$fl = 0;
		foreach ($aut as $aid)
		{
			$query2 = "select * from author_kannada where authid=$aid";
			$result2 = $db->query($query2); 
			$row2 = $result2->fetch_assoc();
			$authorname=$row2['authorname'];
			if($fl == 0)
			{
				$disp_author = $disp_author . "<span class=\"authorspan\"><a href=\"auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "&amp;type=$type\">$authorname</a></span>";
				$fl = 1;
			}
			else
			{
				$disp_author = $disp_author .  "<span class=\"authorspan\">&nbsp;;&nbsp;</span><span class=\"authorspan\"><a href=\"auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "&amp;type=$type\">$authorname</a></span>";
			}
		}
		$result2->free();
	}
	return $disp_author;
	
}
function getBookInfo($row = array())
{
	$level = $row['level'];
	$title = $row['title'];
	$authorname = $row['authorname'];
	$page = $row['page'];
	$page_end = $row['page_end'];
	$edition = $row['edition'];
	$volume = $row['volume'];
	$part = $row['part'];
	$year = $row['year'];
	$month = $row['month'];
	$month_name = array("0"=>"","1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");		
	$book_info = '';
	if($edition != '00')
	{
		$edition_name = array("1"=>"ಮೊದಲನೇ","2"=>"ಎರಡನೇ","3"=>"ಮೂರನೇ","4"=>"ನಾಲ್ಕನೇ","5"=>"ಐದನೇ","6"=>"ಆರನೇ","7"=>"ಏಳನೇ","8"=>"ಎಂಟನೇ","9"=>"ಒಂಬತ್ತನೇ","10"=>"ಹತ್ತನೇ","19"=>"ಹತ್ತೊಂಭತ್ತನೇ");
		$book_info = $book_info . $edition_name[intval($edition)] . "&nbsp;ಆವೃತ್ತಿ  | ";
	}
	if($volume != '00')
	{
		$book_info = $book_info . " ಸಂಪುಟ " . intval($volume) . " | ";
	}
	if($part != '00')
	{
		$book_info = $book_info . " ಭಾಗ  " . intval($part) . " | ";
	}
	if(intval($page) != 0)
	{
		$book_info = $book_info . " pp " . intval($page) . " - " . intval($page_end);
	}
	if(intval($year) != 0)
	{
		$book_info = $book_info . " | " . $month_name[intval($month)] . " " . intval($year);
	}
	$book_info = preg_replace("/^ /", "", $book_info);
	$book_info = preg_replace("/^\|/", "", $book_info);
	$book_info = preg_replace("/^ /", "", $book_info);
	return 	$book_info;
}
?>
