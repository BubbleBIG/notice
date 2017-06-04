<?php
    require_once ('connect.php');
    header("Content-type: text/html; charset=utf-8");
    $nid = $_POST['nid'];
    $result = mysqli_query($link, "select * from notices where nid=$nid");
    $data = [];
    $data = mysqli_fetch_array($result);
    echo json_encode($data);
?>