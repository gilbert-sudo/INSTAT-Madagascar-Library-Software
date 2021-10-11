<?php

// The location of the PDF file
// on the server
if (isset($_GET['name'])) {
	
	$filename = $_GET['name'];
}


// Header content type
header("Content-type: application/pdf");

header("Content-Length: " . filesize($filename));

// Send the file to the browser.
readfile('books/'.$filename);
?>
