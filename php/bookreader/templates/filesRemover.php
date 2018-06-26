<?php
	$jpg = 'find ../../../Volumes/english_books/jpg/1/ +mmin 10 -type f -name "*.jpg" -exec rm {} \;';
	exec($jpg);
	$tif = 'find ../../../Volumes/english_books/tif/ +mmin 10 -type f -name "*.tif" -exec rm {} \;';
	exec($tif);
	
	$jpg = 'find ../../../Volumes/kannada_books/jpg/1/ +mmin 10 -type f -name "*.jpg" -exec rm {} \;';
	exec($jpg);
	$tif = 'find ../../../Volumes/kannada_books/tif/ +mmin 10 -type f -name "*.tif" -exec rm {} \;';
	exec($tif);
	
	$jpg = 'find ../../../Volumes/sanskrit_books/jpg/1/ +mmin 10 -type f -name "*.jpg" -exec rm {} \;';
	exec($jpg);
	$tif = 'find ../../../Volumes/sanskrit_books/tif/ +mmin 10 -type f -name "*.tif" -exec rm {} \;';
	exec($tif);
	
	$jpg = 'find ../../../Volumes/other_books/jpg/1/ +mmin 10 -type f -name "*.jpg" -exec rm {} \;';
	exec($jpg);
	$tif = 'find ../../../Volumes/other_books/tif/ +mmin 10 -type f -name "*.tif" -exec rm {} \;';
	exec($tif);
?>
