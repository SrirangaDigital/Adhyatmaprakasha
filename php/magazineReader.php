<?php
	$url ="";
	if(isset($_GET['volume']) && $_GET['volume'] != ''){$volume = $_GET['volume']; $url = "volume=".$volume;}
	if(isset($_GET['issue']) && $_GET['issue'] != ''){$issue = $_GET['issue']; $url .= "&issue=".$issue;}
	if(isset($_GET['page']) && $_GET['page'] != ''){$page = $_GET['page']; $url .= "&page=".$page;}
	if(isset($_GET['year']) && $_GET['year'] != ''){$year = $_GET['year']; $url .= "&year=".$year;}
	if(isset($_GET['month']) && $_GET['month'] != ''){$month = $_GET['month']; $url .= "&month=".$month;}
	header("Location: magazineReader/templates/book.php?".$url);
?>
