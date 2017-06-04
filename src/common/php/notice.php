<?php
    require_once ('connect.php');
    $aid = $_POST['aid'];
    $result = mysqli_query($link, "select * from area_notices where aid=$aid limit 10");
    $i = 0;
    $data = [];
    while($row = mysqli_fetch_array($result)){
        $data[$i] = $row;
        $i += 1;
    }
    // echo json_encode(array_chunk($data, 10));
    echo json_encode($data);
?>