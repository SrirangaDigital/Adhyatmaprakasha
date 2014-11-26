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
						<li><a href="articles.php?letter= ">Articles</a></li>
						<li><a href="authors.php">Authors</a></li>
					</ul>
				</li>
				<li><a href="publications.php">Publications</a>
					<ul id="pubnav">
						<li><a href="kannada_books.html">Kannada Books</a></li>
						<li><a href="sanskrit_books.html">Sanskrit Books</a></li>
						<li><a href="english_books.html">English Books</a></li>
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
			<div class="title">List of Authors</div>
			<div class="alphabet">
				<span class="letter"><a href="authors.php?letter= ">All</a></span>
				<span class="letter"><a href="authors.php?letter=ಅ">ಅ</a></span>
				<span class="letter"><a href="authors.php?letter=ಆ">ಆ</a></span>
				<span class="letter"><a href="authors.php?letter=ಇ">ಇ</a></span>
				<span class="letter"><a href="authors.php?letter=ಉ">ಉ</a></span>
				<span class="letter"><a href="authors.php?letter=ಋ">ಋ</a></span>
				<span class="letter"><a href="authors.php?letter=ಎ">ಎ</a></span>
				<span class="letter"><a href="authors.php?letter=ಒ">ಒ</a></span>
				<span class="letter"><a href="authors.php?letter=ಕ">ಕ</a></span>
				<span class="letter"><a href="authors.php?letter=ಗ">ಗ</a></span>
				<span class="letter"><a href="authors.php?letter=ಚ">ಚ</a></span>
				<span class="letter"><a href="authors.php?letter=ಜ">ಜ</a></span>
				<span class="letter"><a href="authors.php?letter=ತ">ತ</a></span>
				<span class="letter"><a href="authors.php?letter=ದ">ದ</a></span>
				<span class="letter"><a href="authors.php?letter=ನ">ನ</a></span>
				<span class="letter"><a href="authors.php?letter=ಪ">ಪ</a></span>
				<span class="letter"><a href="authors.php?letter=ಮ">ಮ</a></span>
				<span class="letter"><a href="authors.php?letter=ಯ">ಯ</a></span>
				<span class="letter"><a href="authors.php?letter=ರ">ರ</a></span>
				<span class="letter"><a href="authors.php?letter=ಲ">ಲ</a></span>
				<span class="letter"><a href="authors.php?letter=ವ">ವ</a></span>
				<span class="letter"><a href="authors.php?letter=ಶ">ಶ</a></span>
				<span class="letter"><a href="authors.php?letter=ಸ">ಸ</a></span>
				<span class="letter"><a href="authors.php?letter=ಹ">ಹ</a></span>		
			</div>
			<?php
				include("connect.php");
				$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
				$rs = mysql_select_db($database,$db) or die("No Database");

				$letter=$_GET['letter'];

				$query = "select authorname from author where authorname like '$letter%' order by authorname";
				$result = mysql_query($query);

				$num_rows = mysql_num_rows($result);
				
				if($num_rows)
				{
					echo("<ul>");
					for($i=1;$i<=$num_rows;$i++)
					{	
						$row=mysql_fetch_assoc($result);
						$authorname = $row['authorname'];
						echo("<li>");
						echo("<span class=\"titlespan\"><a href=\"authart.php?authorname=$authorname\">$authorname</a></span><br /><br />");
						echo("</li>\n");
					}
					echo("</ul>");
				}
			?>
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
				<p><?php include("topviewed.php")?></p>
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
