<?php
ini_set('max_execution_time', 3600);
$update_state = 0;
require_once 'ftp-config.php';
$ftp_conn = ftp_connect($ftp_server);
$ftp_directory = "/htdocs/admin/images/books/";
$local_directory = "img/books/";
$carousel_local_directory = "img/carousel/";
$carousel_ftp_directory = "/htdocs/admin/images/carousel/";
if ($ftp_conn) {
    $login_result = ftp_login($ftp_conn, $ftp_user, $ftp_password);
    if ($login_result) {
        if (ftp_get($ftp_conn, "contact.json", "/htdocs/admin/contact.json", FTP_BINARY)) {
            $response = "success";
        } else {
            $response = "failed";
        }
    
        // Get the contents of carousel directory
        $file_directory = ftp_nlist($ftp_conn, $carousel_ftp_directory);
        foreach ($file_directory as $file) {

            if ($file != "." && $file != "..") {
                $filename = "$carousel_local_directory" . "$file";
                if (!file_exists($filename)) {
                    if (ftp_get($ftp_conn, "$carousel_local_directory" . "$file", "$carousel_ftp_directory" . "$file", FTP_BINARY)) {
                        $response = "success";
                    } else {
                        $response = "failed";
                    }
                    $update_state = 1;
                } else {
                    $response = "success";
                }
            }
        }
        // Get the contents of books directory
        $file_directory = ftp_nlist($ftp_conn, $ftp_directory);
        foreach ($file_directory as $file) {

            if ($file != "." && $file != "..") {
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
            }
        }

        if (ftp_get($ftp_conn, "update.json", "/htdocs/admin/update.json", FTP_BINARY)) {
            $response = "success";
        } else {
            $response = "failed";
        }
        if (ftp_get($ftp_conn, "carousel.json", "/htdocs/admin/carousel.json", FTP_BINARY)) {
            $response = "success";
        } else {
            $response = "failed";
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
    'update_state' => $update_state
);
echo json_encode($res);
