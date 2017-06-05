<?php
    require_once ('connect.php');
    header("Content-type: text/html; charset=utf-8");
    $aid = $_POST['aid'];
    $data = [];
    $result3 = mysqli_query($link, "DELETE FROM `area` WHERE aid='$aid'");
    // 删除
    $row = [];
    if (!$result3) {
        // 删除失败
        $data['status'] = 0;
    } else {
        $result2 = mysqli_query($link, "select * from area where 1");
        // 删除成功则，查询返回新数据
        $row2 = [];
        $i = 0;
        while($row = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
            $row2[$i] = $row;
            $i += 1;
        }
        $data['status'] = 1;
        $data['data'] = $row2;
    }
    echo json_encode($data);
?>