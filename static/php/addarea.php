<?php
    require_once ('connect.php');
    header("Content-type: text/html; charset=utf-8");
    $aname = $_POST['aname'];
    $data = [];
    $result3 = mysqli_query($link, "select * from `area` where aname='$aname'");
    $row = [];
    $result3 = mysqli_fetch_array($result3);
    // 重名检测
    if ($result3) {
        $data['status'] = 2;
    } else {
        $result = mysqli_query($link, "INSERT INTO `area`(`aname`) VALUES ('$aname')");
        // 数据插入
        $data['status'] = 0;
        if ($result) {
            $result2 = mysqli_query($link, "select * from `area` where aname='$aname'");
            // 查询返回新增数据
            // $row = [];
            $row = mysqli_fetch_array($result2);
            $data['status'] = 1;
            $data['data'] = $row;
        }
    }
    echo json_encode($data);
?>