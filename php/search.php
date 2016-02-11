<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/aplogo.ico">
<title>Adhyatma Prakash Karyalaya</title>
<!--
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400italic,400,600,700' rel='stylesheet' type='text/css'>
-->
<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />
<link href="style/style.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lightbox/js/jquery-1.2.6.min.js"></script>
<script>
$(document).ready(function()
{
	$("#sanskrit").hide();
	$("#kannada").show();
	$("#kan").click(function()
	{
		$("#kannada").fadeIn();
		$("#sanskrit").hide();
	});
	$("#san").click(function()
	{
		$("#sanskrit").fadeIn();
		$("#kannada").hide();
	});
});
</script>
<script type="text/javascript" src="js/kannada_kbd.js" charset="UTF-8"></script>    
<script type="text/javascript" src="js/devanagari_kbd.js" charset="UTF-8"></script>    
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
				<li><a class="active" href="search.php">Search</a></li>
			</ul>
		</div>
	</div>
	<div class="content">
		<div class="col1">
			<div class="search_title">Search</div>
<?php

include("connect.php");
require_once("common.php");

?>
			<div class="archive_search">
				<form method="POST" action="search-result.php">
					<div>
						<span class="label"><input name="check[]" type="checkbox" value="magazine" checked="checked"/>&nbsp;&nbsp;Magazine</span><br />
						<span class="label"><input name="check[]" type="checkbox" value="english"/>&nbsp;&nbsp;English Books</span><br />
						<span class="label"><input name="check[]" type="checkbox" value="kannada"/>&nbsp;&nbsp;Kannada Books</span><br />
						<span class="label"><input name="check[]" type="checkbox" value="sanskrit"/>&nbsp;&nbsp;Sanskrit Books</span>
					</div>
 					<br/>
					<table>
						<tr>
							<td class="right"><input class="titlespan wide" name="title" type="text" id="title" onfocus="SetId('title')" placeholder="Title" style="height: 2em; margin: 0.5em 0em 0.5em 0em"/></td>
						</tr>
						<tr>
							<td class="right"><input class="titlespan wide" name="author" type="text" id="author" onfocus="SetId('author')" placeholder="Author" style="height: 2em; margin: 0.5em 0em 0.5em 0em"/></td>
						</tr>
						<tr>
							<td class="right"><input class="titlespan wide" name="text" type="text" id="word" onfocus="SetId('word')" placeholder="Text"  style="height: 2em; margin: 0.5em 0em 0.5em 0em"/></td>
						</tr>
						<tr>
							<td class="submit">
								<input name="searchform" type="submit" class="titlespan med" id="button_search" value="Search"/>
								<input name="resetform" type="reset" class="titlespan med" id="button_reset" value="Reset"/>
							</td>
						</tr>
					</table>
				</form>
				<?php include("kannadaKeybord.php"); ?>
				<?php include("sanskritKeybord.php"); ?>
		</div>
		<div class="stitle">
			<span>Input modes for Kannada and Sanskrit</span><br/>
			<button id="kan">Kannada</button>
			<button id="san">Sanskrit</button>
		</div>
		</div>
		<?php include("include_footer.php");?>
        <div class="clearfix"></div>
	</div>
    <?php include("include_footer_out.php");?>
</div>
</body>
</html>
