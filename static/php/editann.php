<?php
    require_once ('connect.php');
    header("Content-type: text/html; charset=utf-8");
    $an_name = $_POST['an_name'];
    $result = mysqli_query($link, "UPDATE `announcer` SET `an_name`='$an_name' WHERE an_id='1'");
    $data = [];
    $data['status'] = 0;
    if ($result) {
        $data['an_name'] = $an_name;
        $data['status'] = 1;
    }
    // $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
    echo json_encode($data);
?>