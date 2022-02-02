<?php
include 'dbconnect.php';
$product = $_GET['ID'];
$quantity = $_GET['quantity'];
$db = getPdo();
$query = "INSERT INTO favori (id, Product, Quantity) VALUES (Null, :product, :quantity)";
$result = $db->prepare($query);
$result->bindValue(':product', $product);
$result->bindValue(':quantity', $quantity);
$result->execute();

header('Location: description.php?success=1&ID=' . $product);