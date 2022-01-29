<?php
require_once 'dbconnect.php';
$db = getPdo();
$format_table_products = $db->query("DELETE FROM products");
ini_set('max_execution_time', 3600);
$products = file_get_contents('update.json');
$products = json_decode($products, true);
foreach ($products as $product) {
    $sql = "INSERT INTO products (PID, Title, Author, Category, Description, Language, page, new, publishAt, img, pdf) VALUES (:PID, :Title, :Author, :Category, :Description, :Language, :page, :new, :publishAt, :img, :pdf)";
    $insert_data = $db->prepare($sql);
    $insert_data->execute(array(
        ':PID' => $product['PID'],
        ':Title' => $product['title'],
        ':Author' => $product['author'],
        ':Category' => $product['category'],
        ':Description' => $product['description'],
        ':Language' => $product['language'],
        ':page' => $product['page'],
        ':new' => $product['new'],
        ':publishAt' => $product['publishAt'],
        ':img' => $product['img'],
        ':pdf' => $product['pdf']
    ));
}
$update_new = file_get_contents("update.json");
file_put_contents("update_log.json", $update_new);
$state = "finished";
$res = array(
    'state' => $state,
);
echo json_encode($res);
