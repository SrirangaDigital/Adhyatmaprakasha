<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/aplogo.ico">
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
						<li><a href="other_books.php">Other Books</a></li>
					</ul>
				</li>
				<li><a href="appeal.php">Appeal</a></li>
				<li><a href="news.php">News</a></li>
				<li><a class="active" href="contact.php">Contact</a></li>
				<li><a href="search.php">Search</a></li>
			</ul>
		</div>
	</div>
	<div class="content">
		<div class="col1">
			<div class="title">Contact Information</div>
			<div>
                <table class="singletbl">
                    <tr>
                        <td>
                            <span class="bld">Adhyatma Prakasha Karyalaya</span><br />
                            Holenarasipura, <br />
                            Hassan District &ndash; 573211<br />
                            Karnataka, India<br />
                            Phone No. +91-8175-273820.<br />
                            <span class="emph"><a href="mailto:secretary@adhyatmaprakasha.org">secretary@adhyatmaprakasha.org</a></span><br />
                        </td>
                    </tr>
                </table>
			</div>
			<div class="title">Other Branches are:</div>
			<div>
                <table class="pubtbl_contact">
                    <tr>
                        <td>
                            Adhyatma Prakasha Karyalaya<br />
                            c/o Shankaramutt, <br />
                            Matturu (Shimoga)-577203<br />
                            Karnataka, India<br />
                            Phone No. +91-8182-237724<br />
                            Mobile No. 9448836895<br />
                        </td>
                        <td>
                            Adhyatma Prakasha Karyalaya<br />
                            68 (New number 6), 6th Main, 2nd Block,<br />
                            T.R. Nagar, Bengaluru<br />
                            Karnataka, India 560 028.<br />
                            Ph.: +91-80-2676 5548  <br />
                            shankara.bhaskara@gmail.com
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            Adhyatma Pracara Sevashrama<br />
                            Shanti nagar,<br />
                            Rayadurga-515865<br />
                            AndhraPradesh, India<br />
                            Phone No. +91-8495-251485<br />
                            Mobile No. +91-94904-77602<br />
							Mobile No. +91-77029-86402
                        </td>
                    </tr>
                </table>
			</div>
		</div>
		<?php include("include_footer.php");?>
        <div class="clearfix"></div>
	</div>
    <?php include("include_footer_out.php");?>
</div>
</body>
</html>
