<?php

require_once('../../BookReader/BookReader.inc');
//assuming your book path is /data/b/bookid
 
$arch = $_GET['arch'];
$lang = $_GET['lang'];
$id = $_GET['id'];
$title = $_GET['title'];

//~ echo "Arch-->" . $arch . "<br />";
//~ echo "Year-->" . $lang . "<br />";
//~ echo "Issue-->" . $id . "<br />";

$maindir = $arch . "/" . $lang . "/" . $id;
//~ echo $maindir . "<br />";
$langid = $lang . "/" . $id;

BookReader::draw('192.168.1.12',$maindir,$langid,$id,$title);

?>
