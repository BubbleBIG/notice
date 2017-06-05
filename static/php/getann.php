<?php
    require_once ('connect.php');
    header("Content-type: text/html; charset=utf-8");
    $result = mysqli_query($link, "select * from announcer where 1");
    $data = [];
    $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
    echo json_encode($data);
?>