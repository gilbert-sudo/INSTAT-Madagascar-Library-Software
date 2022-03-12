<?php
require_once('dbconnect.php');
$db = getPdo();

$result = $db->prepare("SELECT * FROM products");
$result->execute();
echo json_encode($result->fetchAll());
