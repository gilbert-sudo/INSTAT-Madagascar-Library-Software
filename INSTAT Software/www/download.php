<?php
ini_set('max_execution_time', 3600);
// Store the file name into variable
if (isset($_GET['name']) && isset($_GET['id'])) {
	$file = $_GET['name'];
	$id = $_GET['id'];
}

require_once 'ftp-config.php';
$ftp_conn = ftp_connect($ftp_server);
$ftp_directory = "/htdocs/admin/PDF/";
$local_directory = "books/";
if ($ftp_conn) {
	$login_result = ftp_login($ftp_conn, $ftp_user, $ftp_password);
	if ($login_result) {
		$filename = "$local_directory" . "$file";
		if (!file_exists($filename)) {
			if (ftp_get($ftp_conn, "$local_directory" . "$file", "$ftp_directory" . "$file", FTP_BINARY)) {
				$response = "success";
			} else {
				$response = "failed";
			}
			$update_state = 1;
		} else {
			$response = "success";
		}
	} else {
		$response = "failed";
	}
} else {
	$response = "failed";
}

ftp_close($ftp_conn);


$state = "finished";
$res = array(
	'response' => $response,
	'state' => $state,
	'id' => $id
);
echo json_encode($res);
