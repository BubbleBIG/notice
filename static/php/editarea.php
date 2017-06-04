<?php
    require_once ('connect.php');
    header("Content-type: text/html; charset=utf-8");
    $aid = $_POST['aid'];
    $aname = $_POST['aname'];
    $data = [];
    $result3 = mysqli_query($link, "select * from area where aname='$aname'");
    $row = [];
    $result3 = mysqli_fetch_array($result3);
    // 重名检测
    if ($result3) {
        $data['status'] = 2;
    } else {
        $result = mysqli_query($link, "UPDATE `area` SET `aname`='$aname' WHERE aid=$aid");
        // 数据插入
        $data['status'] = 0;
        if ($result) {
            $result2 = mysqli_query($link, "select * from area where 1");
            // 查询返回新增数据
            $row2 = [];
            $i = 0;
            while($row = mysqli_fetch_array($result2)){
                $row2[$i] = $row;
                $i += 1;
            }
            $data['status'] = 1;
            $data['data'] = $row2;
        }
    }
    echo json_encode($data);
?>