<?php
try {
    $db = new PDO('sqlite:instat.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch (Exception $e) {
    echo '{"status":0, "line":'.__LINE__.'}';
    exit();
}
function getPdo(): PDO
{
    global $db;
    return $db;
}
{
    # code...
}
function fetchdata()
{
    $fichier = __DIR__.DIRECTORY_SEPARATOR . 'update.json';
    $data =  file_get_contents($fichier);
    $data = json_decode($data);
    return $data;
}

