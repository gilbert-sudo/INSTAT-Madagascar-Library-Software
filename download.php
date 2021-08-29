<?php
  
// Store the file name into variable
if (isset($_GET['name'])) {
	$file = $_GET['name'];
	$filename = $_GET['name'];
}

  
// Header content type
header('Content-type: application/pdf');
  
header('Content-Disposition: inline; filename="' . $filename . '"');
  
header('Content-Transfer-Encoding: binary');
  
header('Accept-Ranges: bytes');
  
// Read the file
@readfile($file);
  
?>
