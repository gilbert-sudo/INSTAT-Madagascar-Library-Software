<?php
$update_new = file_get_contents("update.json");
$update_old = file_get_contents("update_log.json");
if ($update_new != $update_old) {
    $need_update = 1;
} else {
    $need_update = 0;
}
$res = array(
    'need_update' => $need_update
);
echo json_encode($res);