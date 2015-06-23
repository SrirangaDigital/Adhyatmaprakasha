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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function()
{
	$("#sanskrit").hide();
	$("#kannada").hide();
	$("#kan").click(function()
	{
		$("#kannada").show();
		$("#sanskrit").hide();
	});
	$("#san").click(function()
	{
		$("#sanskrit").show();
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
			<div class="title">Search</div><br />
<?php

include("connect.php");
require_once("common.php");

?>
			<div class="archive_search">
				<form method="POST" action="search-result.php">
					<table>
						<tr>
							<td>
								<span class="stitle"><input type="checkbox" value="magazine" checked/>&nbsp;Magazine</span>
							</td>
						</tr>
						<tr>
							<td>
								<span class="stitle"><input type="checkbox" value="eng"/>&nbsp;English Books</span>
							</td>
						</tr>
						<tr>
							<td>
								<span class="stitle"><input type="checkbox" value="kan"/>&nbsp;Kannada Books</span>
							</td>
						</tr>
						<tr>
							<td>
								<span class="stitle"><input type="checkbox" value="san"/>&nbsp;Sanskrit Books</span>
							</td>
						</tr>
						<tr>
							<td class="left"><label class="label">Title</label></td>
							<td class="right"><input name="text" type="text" id="title" onfocus="SetId('title')" style="height: 2em; margin: 0.5em 0em 0.5em 0em"/></td>
						</tr>
						<tr>
							<td class="left"><label class="label">Author</label></td>
							<td class="right"><input name="text" type="text" id="author" onfocus="SetId('author')" style="height: 2em; margin: 0.5em 0em 0.5em 0em"/></td>
						</tr>
						<tr>
							<td class="left"><label class="label">Word</label></td>
							<td class="right"><input name="text" type="text" id="word" onfocus="SetId('word')" style="height: 2em; margin: 0.5em 0em 0.5em 0em"/></td>
						</tr>
						<tr>
							<td class="left">&nbsp;</td>
							<td class="submit">
								<input name="button1" type="submit" class="buttons" id="button" value="Submit"/>
								<input name="button2" type="reset" class="buttons" id="button2" value="Reset"/>
							</td>
						</tr>
					</table>
				</form>
			<div id="kannada">
				<div class="keys tline lline" id="a" onclick="InsertText('ಅ')">ಅ</div>
				<div class="keys tline" id="A" onclick="InsertText('ಆ')">ಆ</div>
				<div class="keys tline" id="i" onclick="InsertText('ಇ')">ಇ</div>
				<div class="keys tline" id="I" onclick="InsertText('ಈ')">ಈ</div>
				<div class="keys tline" id="u" onclick="InsertText('ಉ')">ಉ</div>
				<div class="keys tline" id="U" onclick="InsertText('ಊ')">ಊ</div>
				<div class="keys tline" id="Ru" onclick="InsertText('ಋ')">ಋ</div>
				<div class="keys lline" id="RU" onclick="InsertText('ೠ')">ೠ</div>
				<div class="keys" id="e" onclick="InsertText('ಎ')">ಎ</div>
				<div class="keys" id="E" onclick="InsertText('ಏ')">ಏ</div>
				<div class="keys" id="ai" onclick="InsertText('ಐ')">ಐ</div>
				<div class="keys" id="o" onclick="InsertText('ಒ')">ಒ</div>
				<div class="keys" id="O" onclick="InsertText('ಓ')">ಓ</div>
				<div class="keys" id="au" onclick="InsertText('ಔ')">ಔ</div>
				<div class="keys lline" id="M" style="border-bottom: none;" onclick="InsertText('ಂ')">ಂ</div>
				<div class="keys" id="H" style="border-bottom: none;" onclick="InsertText('ಃ')">ಃ</div>
				<div class="keys tline lline" style="clear: left;" id="ka" onclick="InsertText('ಕ')">ಕ</div>
				<div class="keys tline" id="Ka" onclick="InsertText('ಖ')">ಖ</div>
				<div class="keys tline" id="ga" onclick="InsertText('ಗ')">ಗ</div>
				<div class="keys tline" id="Ga" onclick="InsertText('ಘ')">ಘ</div>
				<div class="keys tline" id="kna" onclick="InsertText('ಙ')">ಙ</div>
				<div class="keys lline" style="clear: left;" id="ca" onclick="InsertText('ಚ')">ಚ</div>
				<div class="keys" id="Ca" onclick="InsertText('ಛ')">ಛ</div>
				<div class="keys" id="ja" onclick="InsertText('ಜ')">ಜ</div>
				<div class="keys" id="Ja" onclick="InsertText('ಝ')">ಝ</div>
				<div class="keys" id="cna" onclick="InsertText('ಞ')">ಞ</div>
				<div class="keys lline" style="clear: left;" id="Ta" onclick="InsertText('ಟ')">ಟ</div>
				<div class="keys" id="Tha" onclick="InsertText('ಠ')">ಠ</div>
				<div class="keys" id="Da" onclick="InsertText('ಡ')">ಡ</div>
				<div class="keys" id="Dha" onclick="InsertText('ಢ')">ಢ</div>
				<div class="keys" id="Na" onclick="InsertText('ಣ')">ಣ</div>
				<div class="keys lline" style="clear: left;" id="ta" onclick="InsertText('ತ')">ತ</div>
				<div class="keys" id="tha" onclick="InsertText('ಥ')">ಥ</div>
				<div class="keys" id="da" onclick="InsertText('ದ')">ದ</div>
				<div class="keys" id="dha" onclick="InsertText('ಧ')">ಧ</div>
				<div class="keys" id="na" onclick="InsertText('ನ')">ನ</div>
				<div class="keys lline" style="clear: left;border-bottom:none;" id="pa" onclick="InsertText('ಪ')">ಪ</div>
				<div class="keys" id="Pa" style="border-bottom: none;" onclick="InsertText('ಫ')">ಫ</div>
				<div class="keys" id="ba" style="border-bottom: none;" onclick="InsertText('ಬ')">ಬ</div>
				<div class="keys" id="Ba" style="border-bottom: none;" onclick="InsertText('ಭ')">ಭ</div>
				<div class="keys" id="ma" style="border-bottom: none;" onclick="InsertText('ಮ')">ಮ</div>
				<div class="keys lline tline" style="clear: left;" id="ya" onclick="InsertText('ಯ')">ಯ</div>
				<div class="keys tline" id="ra" onclick="InsertText('ರ')">ರ</div>
				<div class="keys tline" id="la" onclick="InsertText('ಲ')">ಲ</div>
				<div class="keys tline" id="va" onclick="InsertText('ವ')">ವ</div>
				<div class="keys tline" id="Sa" onclick="InsertText('ಷ')">ಷ</div>
				<div class="keys tline" id="sha" onclick="InsertText('ಶ')">ಶ</div>
				<div class="keys tline" id="sa" onclick="InsertText('ಸ')">ಸ</div>
				<div class="keys lline" id="ha" style="border-bottom: none;" onclick="InsertText('ಹ')">ಹ</div>
				<div class="keys" id="La" style="border-bottom: none;" onclick="InsertText('ಳ')">ಳ</div>
				<div class="keys lline tline" style="clear: left;" id="Akara" onclick="InsertText('ಾ')">ಾ</div>
				<div class="keys tline" id="ikara" onclick="InsertText('ಿ')">ಿ</div>
				<div class="keys tline" id="Ikara" onclick="InsertText('ೀ')">ೀ</div>
				<div class="keys tline" id="ukara" onclick="InsertText('ು')">ು</div>
				<div class="keys tline" id="Ukara" onclick="InsertText('ೂ')">ೂ</div>
				<div class="keys tline" id="Rkara" onclick="InsertText('ೃ')">ೃ</div>
				<div class="keys tline" id="RRkara" onclick="InsertText('ೄ')"> ೄ</div>
				<div class="keys lline" id="ekara" onclick="InsertText('ೆ')">ೆ</div>
				<div class="keys" id="Ekara" onclick="InsertText('ೇ')">ೇ</div>
				<div class="keys" id="aikara" onclick="InsertText('ೈ')">ೈ</div>
				<div class="keys" id="okara" onclick="InsertText('ೊ')">ೊ</div>
				<div class="keys" id="Okara" onclick="InsertText('ೋ')">ೋ</div>
				<div class="keys" id="aukara" onclick="InsertText('ೌ')">ೌ</div>
				<div class="keys" id="halanta" onclick="InsertText('್')">್</div>
			</div>
			<div id="sanskrit">
				<div class="keys tline lline" id="a" onclick="InsertText('अ')">अ</div>
				<div class="keys tline" id="A" onclick="InsertText('आ')">आ</div>
				<div class="keys tline" id="i" onclick="InsertText('इ')">इ</div>
				<div class="keys tline" id="I" onclick="InsertText('ई')">ई</div>
				<div class="keys tline" id="u" onclick="InsertText('उ')">उ</div>
				<div class="keys tline" id="U" onclick="InsertText('ऊ')">ऊ</div>
				<div class="keys tline" id="Ru" onclick="InsertText('ऋ')">ऋ</div>
				<div class="keys lline" id="RU" onclick="InsertText('ॠ')">ॠ</div>
				<div class="keys" id="e" onclick="InsertText('ए')">ए</div>
				<div class="keys" id="ai" onclick="InsertText('ऐ')">ऐ</div>
				<div class="keys" id="o"  onclick="InsertText('ओ')">ओ</div>
				<div class="keys" id="au" onclick="InsertText('औ')">औ</div>
				<div class="keys" id="M"  onclick="InsertText('ं')">ं</div>
				<div class="keys" id="H"  onclick="InsertText('ः')">ः</div>
				<div class="keys lline" style="clear: left;" id="ka" onclick="InsertText('क')">क</div>
				<div class="keys" id="Ka" onclick="InsertText('ख')">ख</div>
				<div class="keys" id="ga" onclick="InsertText('ग')">ग</div>
				<div class="keys" id="Ga" onclick="InsertText('घ')">घ</div>
				<div class="keys" id="kna" onclick="InsertText('ङ')">ङ</div>
				<div class="keys lline" style="clear: left;" id="ca" onclick="InsertText('च')">च</div>
				<div class="keys" id="Ca" onclick="InsertText('छ')">छ</div>
				<div class="keys" id="ja" onclick="InsertText('ज')">ज</div>
				<div class="keys" id="Ja" onclick="InsertText('झ')">झ</div>
				<div class="keys" id="cna" onclick="InsertText('ञ')">ञ</div>
				<div class="keys lline" style="clear: left;" id="Ta" onclick="InsertText('ट')">ट</div>
				<div class="keys" id="Tha" onclick="InsertText('ठ')">ठ</div>
				<div class="keys" id="Da" onclick="InsertText('ड')">ड</div>
				<div class="keys" id="Dha" onclick="InsertText('ढ')">ढ</div>
				<div class="keys" id="Na" onclick="InsertText('ण')">ण</div>
				<div class="keys lline" style="clear: left;" id="ta" onclick="InsertText('त')">त</div>
				<div class="keys" id="tha" onclick="InsertText('थ')">थ</div>
				<div class="keys" id="da" onclick="InsertText('द')">द</div>
				<div class="keys" id="dha" onclick="InsertText('ध')">ध</div>
				<div class="keys" id="na" onclick="InsertText('न')">न</div>
				<div class="keys lline" style="clear: left;border-bottom:none;" id="pa" onclick="InsertText('प')">प</div>
				<div class="keys" id="Pa" style="border-bottom: none;" onclick="InsertText('फ')">फ</div>
				<div class="keys" id="ba" style="border-bottom: none;" onclick="InsertText('ब')">ब</div>
				<div class="keys" id="Ba" style="border-bottom: none;" onclick="InsertText('भ')">भ</div>
				<div class="keys" id="ma" style="border-bottom: none;" onclick="InsertText('म')">म</div>
				<div class="keys lline tline" style="clear: left;" id="ya" onclick="InsertText('य')">य</div>
				<div class="keys tline" id="ra" onclick="InsertText('र')">र</div>
				<div class="keys tline" id="la" onclick="InsertText('ल')">ल</div>
				<div class="keys tline" id="va" onclick="InsertText('व')">व</div>
				<div class="keys tline" id="Sa" onclick="InsertText('श')">श</div>
				<div class="keys tline" id="sha" onclick="InsertText('ष')">ष</div>
				<div class="keys tline" id="sa" onclick="InsertText('स')">स</div>
				<div class="keys lline" id="ha" onclick="InsertText('ह')">ह</div>
				<div class="keys" id="La" onclick="InsertText('ळ')">ळ</div>
				<div class="keys lline" style="clear: left;" id="Akara" onclick="InsertText('ा')">ा</div>
				<div class="keys" id="ikara" onclick="InsertText('ि')">ि</div>
				<div class="keys tline" id="Ikara" onclick="InsertText('ी')">ी</div>
				<div class="keys tline" id="ukara" onclick="InsertText('ु')">ु</div>
				<div class="keys tline" id="Ukara" onclick="InsertText('ू')">ू</div>
				<div class="keys tline" id="Rukara" onclick="InsertText('ृ')">ृ</div>
				<div class="keys tline" id="RUkara" onclick="InsertText('ृ')">ॄ</div>
				<div class="keys lline" id="ekara" style="clear: left;" onclick="InsertText('े')">े</div>
				<div class="keys" id="aikara" onclick="InsertText('ै')">ै</div>
				<div class="keys" id="okara" onclick="InsertText('ो')">ो</div>
				<div class="keys" id="aukara" onclick="InsertText('ौ')">ौ</div>
				<div class="keys" id="halanta" onclick="InsertText('् ')">् </div>
			</div>
		</div>
		<div class="stitle">Input modes for Kannada and Sanskrit</div>
		<button id="kan">Kannada</button>
		<button id="san">Sanskrit</button>
		</div>
		<?php include("include_footer.php");?>
        <div class="clearfix"></div>
	</div>
    <?php include("include_footer_out.php");?>
</div>
</body>
</html>
