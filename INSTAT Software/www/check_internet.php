<?php
ini_set('max_execution_time', 3600);
$state = 0;
require_once 'ftp-config.php';
$ftp_conn = ftp_connect($ftp_server);

if ($ftp_conn) {
    $response = "success";
} else {
    $response = "failed";
}

ftp_close($ftp_conn);


$state = "finished";
$res = array(
    'response' => $response,
    'state' => $state,
);
echo json_encode($res);
