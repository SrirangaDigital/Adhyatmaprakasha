<?php
	session_start();
?>
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
						<li><a href="articles.php">Articles</a></li>
						<li><a href="authors.php">Authors</a></li>
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
			</p>
		</div>
		<div class="colmiddle">
            <div class="archive_holder">
<?php
	include("connect.php");
	require_once("common.php");

	$check = $_POST['check'];
	$author = $_POST['author'];
	$text = $_POST['text'];
	$title = $_POST['title'];

	$title = entityReferenceReplace($title);
	$author = entityReferenceReplace($author);
	$text = entityReferenceReplace($text);

	if(!(isValidTitle($title) && isValidAuthor($author) && isValidText($text)))
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

	if($title=='')
	{
		$title='[a-z]*';
	}
	if($author=='')
	{
		$author='[a-z]*';
	}

	$authorFilter = '';
	$titleFilter = '';
	$textFilter = '';
	$query = '';
	
	$authors = preg_split("/ /", $author);
	$titles = preg_split("/ /", $title);
	$texts = preg_split("/ /", $text);
	$first = 0;
	$oldId = '';

	for($ic=0;$ic<sizeof($authors);$ic++)
	{
		$authorFilter .= "and authorname REGEXP '" . $authors[$ic] . "' ";
	}
	
	for($ic=0;$ic<sizeof($titles);$ic++)
	{
		$titleFilter .= "and title REGEXP '" . $titles[$ic] . "' ";
	}
	
	for($ic=0;$ic<sizeof($texts);$ic++)
	{
		$textFilter .= "+" . $texts[$ic] . "* ";
	}

	$authorFilter = preg_replace("/^and /", "", $authorFilter);
	$titleFilter = preg_replace("/^and /", "", $titleFilter);
	$authorFilter = preg_replace("/ $/", "", $authorFilter);
	$titleFilter = preg_replace("/ $/", "", $titleFilter);

	if($text == '')
	{
		$iquery{'magazine'} = "(SELECT title, authid, authorname, page, CONCAT_WS('&&&', 'magazine', volume, issue, year, month, titleid) as info FROM article WHERE $authorFilter AND $titleFilter ORDER BY volume, issue, page)";
		$iquery{'english'} = "(SELECT title , authid, authorname, page, CONCAT_WS('&&&', type, volume, part, year, month, book_id, edition, 'btitle') as info FROM english_books_list WHERE $authorFilter AND $titleFilter ORDER BY volume, part, page) UNION ALL (SELECT title , 'authid', 'authorname' , page,CONCAT_WS('&&&', type, 'volume', 'part', 'year', 'month', book_id, 'edition', 'atitle') as info FROM english_book_toc where $titleFilter)";
		$iquery{'kannada'} = "(SELECT title , authid, authorname, page, CONCAT_WS('&&&', type, volume, part, year, month, book_id, edition, 'btitle') as info FROM kannada_books_list WHERE $authorFilter AND $titleFilter ORDER BY volume, part, page) UNION ALL (SELECT title , 'authid', 'authorname' , page,CONCAT_WS('&&&', type, 'volume', 'part', 'year', 'month', book_id, 'edition', 'atitle') as info FROM kannada_book_toc where $titleFilter)";
		$iquery{'sanskrit'} = "(SELECT title , authid, authorname, page, CONCAT_WS('&&&', type, volume, part, year, month, book_id, edition, 'btitle') as info FROM sanskrit_books_list WHERE $authorFilter AND $titleFilter ORDER BY volume, part, page) UNION ALL (SELECT title , 'authid', 'authorname' , page,CONCAT_WS('&&&', type, 'volume', 'part', 'year', 'month', book_id, 'edition', 'atitle') as info FROM sanskrit_book_toc where $titleFilter)";
		
		for($ic=0;$ic<sizeof($check);$ic++)
		{
			if($check[$ic] != '')
			{
				$query = $query . " UNION ALL " . $iquery{$check[$ic]};
			}
		}
		$query = preg_replace("/^ UNION ALL /", "", $query);
	}
	else
	{
		$text = rtrim($text);
		$texts = preg_split("/ /", $text);
		$textFilter = "";
		for($ic=0;$ic<sizeof($texts);$ic++)
		{
			$textFilter .= $texts[$ic] . "* ";
		}
		
		$iquery{'magazine'} = "(SELECT * FROM
									(SELECT * FROM
										(SELECT title, authid, authorname, cur_page,  page, CONCAT_WS('&&&', 'magazine', volume, issue, year, month) as info, 'type', titleid FROM searchtable_magazine WHERE MATCH (text) AGAINST ('$textFilter' IN BOOLEAN MODE)) AS tb1
									WHERE $authorFilter) AS tb2
								WHERE $titleFilter ORDER BY titleid, cur_page)";
								
		$iquery{'english'} = "(SELECT * FROM
									(SELECT * FROM
										(SELECT title, authid, authorname, cur_page,  page, CONCAT_WS('&&&', type, volume, part, year, month, book_id, edition, 'btitle') as info , type, book_id FROM searchtable_books WHERE MATCH (text) AGAINST ('$textFilter' IN BOOLEAN MODE)) AS tb1
									WHERE $authorFilter) AS tb2
								WHERE $titleFilter and type = 'english' ORDER BY book_id, cur_page)";
								
		$iquery{'kannada'} = "(SELECT * FROM
									(SELECT * FROM
										(SELECT title, authid, authorname, cur_page,  page, CONCAT_WS('&&&', type, volume, part, year, month, book_id, edition, 'btitle') as info, type, book_id FROM searchtable_books WHERE MATCH (text) AGAINST ('$textFilter' IN BOOLEAN MODE)) AS tb1
									WHERE $authorFilter) AS tb2
								WHERE $titleFilter and type = 'kannada' ORDER BY book_id, cur_page)";
								
		$iquery{'sanskrit'} = "(SELECT * FROM
									(SELECT * FROM
										(SELECT title, authid, authorname, cur_page, page, CONCAT_WS('&&&', type, volume, part, year, month, book_id, edition, 'btitle') as info, type, book_id FROM searchtable_books WHERE MATCH (text) AGAINST ('$textFilter' IN BOOLEAN MODE)) AS tb1
									WHERE $authorFilter) AS tb2
								WHERE $titleFilter and type = 'sanskrit' ORDER BY book_id, cur_page)";
								
		
		for($ic=0;$ic<sizeof($check);$ic++)
		{
			if($check[$ic] != '')
			{
				$query = $query . " UNION ALL " . $iquery{$check[$ic]};
			}
		}
		$query = preg_replace("/^ UNION ALL /", "", $query);
	}
	
	//~ echo $query."<br/>";
	$result = $db->query($query) or die("<br/>Query False". $db->error); 
	$num_rows = $result ? $result->num_rows : 0;
	$bullet = "<img class=\"bpointer\" src=\"images/bullet_1.gif\" alt=\"Point\" />";
	echo "<div class=\"page_booktitle\">Search Result</div>";
	$_SESSION['sd'] = "";
	
	if($num_rows)
	{
		echo "<div class=\"treeview\">";
		echo "<div class=\"search_result\">$num_rows result(s)</div><br />";
		echo "	<ul>";
		
		while($row = $result->fetch_assoc())
		{
			$title = $row['title'];
			$authid = $row['authid'];
			$info = preg_split('/&&&/',$row['info']);
			$type = $info[0];
			$bookInfo = '';
			$page = $row['page'];
			if($first != 0 && ((strcmp($currentId, $oldId)) != 0))
			{
				echo "	</li>";
				$oldId = $currentId;
			}
			
			if($type == 'magazine')
			{
				$volume = $info[1];
				$issue = $info[2];
				$year =  $info[3];
				$month =  $info[4];
				$currentId = $info[5];
				$titleString = "		$bullet&nbsp;<span class=\"titlespan\"><a target=\"_blank\" href=\"magazineReader.php?volume=$volume&amp;issue=$issue&amp;page=$page&amp;year=$year&amp;month=$month\">$title</a></span>";
				$authorString = getAuthorDetails($authid,$db);
				$bookInfo = "<br/><span class=\"space_left\"><span class=\"infospan\">" . getMagazineInfo($row, $db) . "</span></span>";
			}
			else
			{
				$currentId = $info[5];
				$titleString =  "		$bullet&nbsp;<span class=\"titlespan\"><a target=\"_blank\" href=\"bookReader.php?book_id=$currentId&amp;page=$page&amp;type=$type\">$title</a></span>";
				$authid = ($authid == 'authid')? getAuthid($db, $currentId, $type) : $authid;
				$authorString = getAuthorDetails($authid,$db,$type);
				$bookInfo = "<br/><span class=\"space_left\"><span class=\"infospan\">" . getBookInfo($row, $db) . "</span></span>";
			}
			if ((strcmp($currentId, $oldId)) != 0)
			{
				echo "	<li>";
				echo $titleString;
				if($authid != '' && $authid!= 0)
				{
					echo '<br/>'.$authorString;
				}
				if($bookInfo != '')
				{
					echo $bookInfo;
				}
				if($text != '')
				{
					$roman = 1;
					preg_match("/[a-z]/", $row['cur_page']) ? $displayCurPage = romanNumerals($roman++) : ( (intval($row['cur_page']) == 0) ? $displayCurPage = romanNumerals($roman++) : $displayCurPage = intval($row['cur_page']));
					echo '<br/><span class="sub_titlespan">Text match found at page(s) : </span>';
					($type == 'magazine') ?	( $searchResult = "<span class=\"infospan\"><a href=\"magazineReader.php?volume=$volume&amp;issue=$issue&amp;page=" . $row['cur_page'] . "&amp;year=$year&amp;month=$month&amp;text=$text\" target=\"_blank\">" . $displayCurPage . "</a> </span>&nbsp;" AND $_SESSION['sd'][$type.$volume.$issue][] = $row['cur_page']) : ( $searchResult =  "<span class=\"infospan\"><a href=\"bookReader.php?book_id=$currentId&amp;page=" . $row['cur_page'] . "&amp;type=$type&amp;text=$text\" target=\"_blank\">" . $displayCurPage . "</a> </span>&nbsp" AND $_SESSION['sd'][$type.$currentId][] = $row['cur_page']);
					echo $searchResult;
				}
				$oldId = $currentId;
			}
			elseif($text != '')
			{
				preg_match("/[a-z]/", $row['cur_page']) ? $displayCurPage = romanNumerals($roman++) : ( (intval($row['cur_page']) == 0) ? $displayCurPage = romanNumerals($roman++) : $displayCurPage = intval($row['cur_page']));
				($type == 'magazine') ?	($searchResult = "<span class=\"infospan\"><a href=\"magazineReader.php?volume=$volume&amp;issue=$issue&amp;page=" . $row['cur_page'] . "&amp;year=$year&amp;month=$month&amp;text=$text\" target=\"_blank\">" . $displayCurPage . "</a> </span>&nbsp;"  AND $_SESSION['sd'][$type.$volume.$issue][] = $row['cur_page']) : ($searchResult =  "<span class=\"infospan\"><a href=\"bookReader.php?book_id=$currentId&amp;page=" . $row['cur_page'] . "&amp;type=$type&amp;text=$text\" target=\"_blank\">" . $displayCurPage . "</a> </span>&nbsp" AND $_SESSION['sd'][$type.$currentId][] = $row['cur_page']);
				echo $searchResult;
			}
			$first = 1;
		}
		
		echo "	</ul>";
		echo "</div>";
	}
else
{
	
	echo "<br/><span class=\"titlespan\">No results</span><br/>";
	echo "<span class=\"infospan\"><a href=\"search.php\">Go back and search again</a></span>";
}

if($result){$result->free();}
$db->close();
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


<?php
function getAuthorDetails($authid,$db,$type = null)
{
	$disp_author = "";
	$qtype = $type;
	$type = ($type != null) ? '_'.$type : $type;
	if($authid != '')
	{
		$disp_author =  "<span class=\"authorspan\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&mdash;&nbsp;</span>";
		$aut = preg_split('/;/',$authid);
		$fl = 0;
		foreach ($aut as $aid)
		{
			$query2 = "select * from author" . $type . " where authid=$aid";
			
			$result2 = $db->query($query2); 
			$row2 = $result2->fetch_assoc();
			$authorname=$row2['authorname'];
			if($fl == 0)
			{
				if($qtype == null)
				{
					$disp_author = $disp_author . "<span class=\"authorspan\"><a href=\"auth_magazine.php?authid=$aid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
				}
				else
				{
					$disp_author = $disp_author . "<span class=\"authorspan\"><a href=\"auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "&amp;type=$qtype\">$authorname</a></span>";
				}
				
				$fl = 1;
			}
			else
			{
				if($qtype == null)
				{
					$disp_author = $disp_author . "<span class=\"authorspan\">&nbsp;&nbsp;<a href=\"auth_magazine.php?authid=$aid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
				}
				else
				{
					$disp_author = $disp_author . "<span class=\"authorspan\">&nbsp;&nbsp;<a href=\"auth.php?authid=$aid&amp;author=" . urlencode($authorname) . "&amp;type=$qtype\">$authorname</a></span>";
				}
			}
		}
		$result2->free();
	}
	return $disp_author;
	
}
//~  Function to get Author ID of the book
function getAuthid($db, $currentId, $type)
{
	$query = "SELECT authid from " . $type . "_books_list where book_id = '$currentId' and type='" . $type . "'";
	$result = $db->query($query); 
	$row = $result->fetch_assoc();
	return $row['authid'];
}
function getMagazineInfo($row = array(), $db)
{
	$title = $row['title'];
	$authid = $row['authid'];
	$info = preg_split('/&&&/',$row['info']);
	$volume = $info[1];
	$issue = $info[2];
	$year = $info[3];
	$month = $info[4];
	
	$magazineInfo =  "<a href=\"toc.php?vol=$volume&amp;issue=$issue\">
							<span style=\"font-size: 1.1em;\">ಸಂಪುಟ.</span>&nbsp;".intval($volume)."
							&nbsp;(<span style=\"font-size: 1.1em;\">ಸಂಚಿಕೆ.</span> ".$issue.")&nbsp;;&nbsp;$month&nbsp;".$year."
					</a>";
	return $magazineInfo;
}
function getBookInfo($row = array(), $db)
{
	$title = $row['title'];
	$authorname = $row['authorname'];
	$info = preg_split('/&&&/',$row['info']);
	$type = $info[0];
	$currentId = $info[5];
	
	if($info[7] == 'atitle')
	{
		$query_aux = "SELECT CONCAT_WS('&&&', type, volume, part, year, month, book_id, edition, 'btitle') as info from " . $type . "_books_list where book_id='$currentId' and type='" . $type . "'";
		$result_aux = $db->query($query_aux); 
		$num_rows_aux = $result_aux ? $result_aux->num_rows : 0;
		$row_aux = $result_aux->fetch_assoc();
		$info = preg_split('/&&&/',$row_aux['info']);
	}
	
	$edition = $info[6];
	$volume = $info[1];
	$part = $info[2];
	$year = $info[3];
	$month = $info[4];
	$month_name = array("0"=>"","1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");		
	$book_info = '';
	
	if($edition != '00')
	{
		($type == 'kannada') ? ($edition_name  = array("1"=>"ಮೊದಲನೇ","2"=>"ಎರಡನೇ","3"=>"ಮೂರನೇ","4"=>"ನಾಲ್ಕನೇ","5"=>"ಐದನೇ","6"=>"ಆರನೇ","7"=>"ಏಳನೇ","8"=>"ಎಂಟನೇ","9"=>"ಒಂಬತ್ತನೇ","10"=>"ಹತ್ತನೇ","19"=>"ಹತ್ತೊಂಭತ್ತನೇ") AND $book_info = $book_info . $edition_name{intval($edition)} . "&nbsp;&nbsp;ಆವೃತ್ತಿ") : (($type == 'english') ? ($edition_name = array("1"=>"First","2"=>"Second","3"=>"Third","4"=>"Fourth","5"=>"Fifth") AND $book_info = $book_info . $edition_name{intval($edition)} . "&nbsp;&nbsp;Edition") : ($edition_name = array("1"=>"पहले ","2"=>"दूसरे ","3"=>"तीसरे ","4"=>"चौथे ","5"=>"पांचवें ") AND  $book_info = $book_info . $edition_name{intval($edition)} . "&nbsp;संस्करण"));
	}
	if($volume != '00')
	{
		($type == 'kannada') ? ($book_info = $book_info . "  |  ಸಂಪುಟ" . intval($volume)) : $book_info = $book_info . " | Volume " . intval($volume);
	}
	if($part != '00')
	{
		($type == 'kannada') ? ($book_info = $book_info . "  |  ಭಾಗ" . intval($part)) : $book_info = $book_info . " | Part " . intval($part);
	}
	if(intval($year) != 0)
	{
		$book_info = $book_info . "&nbsp;&nbsp;|&nbsp;&nbsp;" . $month_name{intval($month)} . " " . intval($year);
	}
	
	$book_info = preg_replace("/^ +/", "", $book_info);
	$book_info = preg_replace("/^\|/", "", $book_info);
	$book_info = preg_replace("/^&nbsp;&nbsp;\|&nbsp;&nbsp;/", "", $book_info);
	$book_info = preg_replace("/^ /", "", $book_info);
	
	return 	$book_info;
}
?>
