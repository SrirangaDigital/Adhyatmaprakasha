<?php
	$url ="";
	if(isset($_GET['type']) && $_GET['type'] != ''){$type = $_GET['type']; $url = "type=".$type;}
	if(isset($_GET['book_id']) && $_GET['book_id'] != ''){$book_id = $_GET['book_id']; $url .= "&book_id=".$book_id;}
	if(isset($_GET['page']) && $_GET['page'] != ''){$page = $_GET['page']; $url .= "&pagenum=".$page;}
	header("Location: bookreader/templates/book.php?".$url);
?>
