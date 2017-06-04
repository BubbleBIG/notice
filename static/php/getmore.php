<?php
    require_once ('connect.php');
    header("Content-type: text/html; charset=utf-8");
    $aid = $_POST['aid'];
    $nid = $_POST['nid'];
    $result = mysqli_query($link, "select * from area_notices where aid=$aid and nid<$nid limit 10");
    $i = 0;
    $data = [];
    while($row = mysqli_fetch_array($result)){
        $data[$i] = $row;
        $i += 1;
    }
    // echo json_encode(array_chunk($data, 10));
    echo json_encode($data);
?>