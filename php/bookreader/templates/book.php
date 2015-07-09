<!DOCTYPE HTML>
<html manifest="appcache.manifest">
<head>

    <title>$book['Title']</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="../static/BookReader/BookReader.css"/>
    <link rel="stylesheet" type="text/css" href="../static/BookReaderDemo.css"/>
    <script type="text/javascript" src="../static/BookReader/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery-ui-1.8.5.custom.min.js"></script>
    <script type="text/javascript " src="../static/BookReader/dragscrollable.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery.ui.ipad.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery.bt.min.js"></script>
    <script type="text/javascript" src="../static/BookReader/BookReader.js"></script>
    
    <?php
		$type = $_GET['type'];
		$book_id = $_GET['book_id'];
		$page = $_GET['pagenum'].".jpg";
		$search = ($_GET['searchText'] && $_GET['searchText'] != '') ?  $_GET['searchText'] : '';
		$djvurl = "../../../Volumes/".$type."_books/djvu/$book_id";
		$imgurl = "../../../Volumes/".$type."_books/jpg/2/$book_id";
		
		$djvulist=scandir($djvurl);
		$cmd='';
		
		for($i=0;$i<count($djvulist);$i++)
		{
			if($djvulist[$i] != '.' && $djvulist[$i] != '..' && preg_match('/(\.djvu)/' , $djvulist[$i]) && !preg_match('/(index\.djvu)/' , $djvulist[$i]))
			{
				$img = preg_split("/\./",$djvulist[$i]);
				$book["imglist"][$i]= $img[0].".jpg";
			}
		}
	
		$book["imglist"]=array_values($book["imglist"]);
		$book["Title"] = "Adhyātmaprakāsha Kāryālaya";
		$book["TotalPages"] = count($book["imglist"]);
		$book["SourceURL"] = "";
		$result = array_keys($book["imglist"], $page);
		$book["pagenum"] = $result[0];
		$book["searchText"] = $search;
		$book["lang"] = $type;
		$book["book_id"] = $book_id;
		$book["imgurl"] = $imgurl;
    ?>
<script type="text/javascript">var book = <?php echo json_encode($book); ?>;</script>
<script>$.ajax({url: "filesRemover.php", async: true});</script>
</head>
<script type="text/javascript" src="../static/BookReader/cacheUpdater.js"></script>
<script type="text/javascript" src="../static/BookReader/checkCached.js"></script>

<body style="background-color: #939598;">

<div id="BookReader">
    
</div>
<script type="text/javascript" src="../static/BookReaderJSSimple.js"></script>
</body>
</html>
