<?php
	$date=htmlspecialchars($_POST["date"]);
	$file=fopen("Resources/Site Data/ElectionDate.txt","w+");
	fwrite($file,$date);
	fclose($file);
	echo "Successfully Changed Election Date";
?>