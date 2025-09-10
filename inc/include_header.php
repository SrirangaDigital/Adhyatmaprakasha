<?php
session_start();
?>
<?php include("cnf.php");?>
<!doctype html>
<html lang="en" class="no-js">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo $base_url; ?>php/images/aplogo.ico">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Adhyatma Prakash Karyalaya</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400italic,400,600,700' rel='stylesheet' type='text/css'>
	<link href="<?php echo $base_url; ?>php/style/reset.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="<?php echo $base_url; ?>php/style/style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="page">
	<header>
		<div class="header">
			<div class="logo"><img src="<?php echo $base_url; ?>php/images/aplogo.png" alt="AP-Logo"/></div>
			<div class="logokalash"><img src="<?php echo $base_url; ?>php/images/kalash.png" alt="kalash"/></div>
			<div class="title">Adhyātmaprakāsha Kāryālaya</div>
			<div class="subtitle">एतज्ज्ञेयं नित्यमेवात्मसंस्थम् | नातः परं वेदितव्यं हि किञ्चित् ||</div>
			<div id="nav">
				<ul>
					<li><a href="<?php echo $base_url; ?>">Home</a></li>
					<li><a href="<?php echo $base_url; ?>php/about.php">About</a></li>
					<li><a href="<?php echo $base_url; ?>php/activity.php">Activities</a></li>
					<li><a href="<?php echo $base_url; ?>php/magazine.php">Magazine</a>
						<ul id="magnav">
							<li><a href="<?php echo $base_url; ?>php/volumes.php">Volumes</a></li>
							<li><a href="<?php echo $base_url; ?>php/articles.php">Articles</a></li>
							<li><a href="<?php echo $base_url; ?>php/authors.php">Authors</a></li>
						</ul>
					</li>
					<li><a href="<?php echo $base_url; ?>php/publications.php">Publications</a>
						<ul id="pubnav">
							<li><a href="<?php echo $base_url; ?>php/kannada_books.php">Kannada Books</a></li>
							<li><a href="<?php echo $base_url; ?>php/sanskrit_books.php">Sanskrit Books</a></li>
							<li><a href="<?php echo $base_url; ?>php/english_books.php">English Books</a></li>
							<li><a href="<?php echo $base_url; ?>php/other_books.php">Other Books</a></li>
						</ul>
					</li>
					<li><a href="<?php echo $base_url; ?>php/appeal.php">Appeal</a></li>
					<li><a href="<?php echo $base_url; ?>php/contact.php">Contact</a></li>
					<li><a href="<?php echo $base_url; ?>php/search.php">Search</a></li>
				</ul>
			</div>
		</div>
	</header>	