<!DOCTYPE HTML>
<html manifest="appcache.manifest">
<head>
    <title>$book['Title']</title>
    
    <link rel="stylesheet" type="text/css" href="../static/BookReader/BookReader.css"/>
    <link rel="stylesheet" type="text/css" href="../static/BookReaderDemo.css"/>
    <script type="text/javascript" src="../static/BookReader/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery-ui-1.8.5.custom.min.js"></script>
    <script type="text/javascript" src="../static/BookReader/dragscrollable.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery.ui.ipad.js"></script>
    <script type="text/javascript" src="../static/BookReader/jquery.bt.min.js"></script>
    <script type="text/javascript" src="../static/BookReader/BookReader.js"></script>
    
    <?php
		$project = $_GET['projectid'];
		$page = $_GET['page'];
		$series = $_GET['snum'];
		$search = $_GET['search'];
		
		$djvurl = "../Volumes/".$series."/".$project;
		$imgurl = "../img";
		
		//~ $cmd = "djvmcvt -i $djvurl/index.djvu $djvurl index.djvu";
		//~ system($cmd);
		$djvulist=scandir($djvurl);
		$cmd='';
		
		for($i=0;$i<count($djvulist);$i++)
		{
			if($djvulist[$i] != '.' && $djvulist[$i] != '..' && preg_match('/(\.djvu)/' , $djvulist[$i]) && !preg_match('/(index\.djvu)/' , $djvulist[$i]))
			{
				$img = split("\.",$djvulist[$i]);
				$book["imglist"][$i]= $img[0].".jpg";
			}
		}
	
		$book["imglist"]=array_values($book["imglist"]);
		$book["Title"] = "Book Reader";
		$book["TotalPages"] = count($book["imglist"]);
		$book["SourceURL"] = "";
		$book["bookId"] = $project;
		$result = array_keys($book["imglist"], $page);
		$book["pagenum"] = $result[0];
		$book["searchText"] = $search;
		$book["series"] = $series;
    ?>
    <script type="text/javascript">var book = <?php echo json_encode($book); ?>;</script>
</head>
<script type="text/javascript" src="../static/BookReader/cacheUpdater.js"></script>
<script type="text/javascript" src="../static/BookReader/checkCached.js"></script>

<body style="background-color: ##939598;">

<div id="BookReader">
    
</div>
<script type="text/javascript" src="../static/BookReaderJSSimple.js"></script>
</body>
</html>
