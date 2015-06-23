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
		<div class="col1">
			<div class="title">Shibira's / Workshops</div>
			<ul>
				<li><span class="titlespan"><a href="w1.php">Vedanta Shibira of October 2009 (09-10-2009 to 15-10-2009)</a></span></li>
				<li><span class="titlespan"><a href="announcement.php">Announcements</a></span></li>
<!--				<li><span class="titlespan"><a href="#">Vedanta Shibira of April 2009 (20-04-2009 to 26-04-2009)</a></span></li>
				<li><span class="titlespan"><a href="#">Vedanta Saptaha in December 2008 (19-12-2008 to 25-12-2008)</a></span></li>
				<li><span class="titlespan"><a href="#">Vedanta Shibira in October 2008 (19-10-2008 to 25-10-2008)</a></span></li>
				<li><span class="titlespan"><a href="#">Vedanta Shibira in July 2008 (14-07-2008 to 18-07-2008)</a></span></li>
				<li><span class="titlespan"><a href="#">Vedanta Shibira in March 2008 (15-03-2008 to 16-03-2008)</a></span></li>
				<li><span class="titlespan"><a href="#">Vedanta Shibira in January 2008 (28-01-2008 to 03-02-2008)</a></span></li>
				<li><span class="titlespan"><a href="#">Vedanta Shibira in September 2007 (26-09-2007 to 06-10-2007)</a></span></li>
-->	
			</ul>
		</div>
		<?php include("include_footer.php");?>
        <div class="clearfix"></div>
	</div>
    <?php include("include_footer_out.php");?>
</div>
</body>
</html>
