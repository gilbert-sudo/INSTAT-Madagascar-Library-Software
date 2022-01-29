<?php 
$id = $_GET['id'];
$origine = $_GET['name'];
$final = "books/$origine";
copy($origine, $final);
header("Location: description.php?ID=$id");
?>