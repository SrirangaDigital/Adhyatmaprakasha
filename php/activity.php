<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Adhyatma Prakash Karyalaya</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400italic,400,600,700' rel='stylesheet' type='text/css'>
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
				<li><a class="active" href="activity.php">Activities</a></li>
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
				<li><a href="search.php">Search</a></li>
			</ul>
		</div>
	</div>
	<div class="content">
		<div class="col1">
			<div class="title">Activities</div>
			<div class="list">
				Adhyatmaprakasha Karyalaya came into being as an Institution to help the interpretation of Indian Culture by stimulating the study and practice of the Adhyatma Vidya-Philosophy and Religion in its universal aspect - especially as revealed in the Upanishads and allied literature. Swamiji selected three principal means to achive this: Lectures &amp; Seminars, Publication &amp; Monthly magazine, Vidyanilaya. The activities of the Karyalaya are built around this.<br /><br />
				<ul>
				<li><span class="emph"><a href="workshop.php">Shibira's / Workshops</a></span></li> 
				<li><span class="emph"><a href="publications.php">Publication</a></span></li>

				<li><span class="emph"><a href="magazine.php">Monthly magazine</a></span></li>
				<li><span class="emph"><a href="vidyanilaya.php">Adhyatma Vidyanilaya</a></span></li> 
				</ul>
				<br /><br />
            </div>
		</div>
		<?php include("include_footer.php");?>
        <div class="clearfix"></div>
	</div>
    <?php include("include_footer_out.php");?>
</div>
</body>
</html>
