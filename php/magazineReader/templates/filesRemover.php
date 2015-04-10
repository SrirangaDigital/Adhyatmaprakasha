<?php
	$jpg = 'find ../../../Volumes/magazine/jpg/1/ +mmin 10 -type f -name "*.jpg" -exec rm {} \;';
	exec($jpg);
	$tif = 'find ../../../Volumes/magazine/tif/ +mmin 10 -type f -name "*.tif" -exec rm {} \;';
	exec($tif);
?>
