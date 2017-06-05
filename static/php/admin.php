<?php
    require_once ('connect.php');
    header("Content-type: text/html; charset=utf-8");
    $aids = $_POST['select'];
    $title = $_POST['title'];
    $text = $_POST['notice'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];
    $time = Date('Y-m-d');
    // $time = time();
    if ($aids == 0) {
        $result = mysqli_query($link, "select * from area where 1");
        // $row = mysqli_fetch_array($result);
        $i = 0;
        // while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        while($row = mysqli_fetch_array($result,MYSQLI_NUM)){
            $aid = (int)$row[0];
            // echo json_encode($endtime);
            mysqli_query($link, "insert into `notices`(`title`, `notice`, `starttime`, `endtime`, `aid`, `time`) VALUES ('$title','$text','$starttime','$endtime','$aid','$time')");
            $i += 1;
            // echo json_encode(['a'=>$aid]);
        }
    } else {
        $arr = explode(',', $aids,strlen($aids));
        // $len = (strlen($aids)+1)/2;
        $len = count($arr);
        for ($i = 0; $i < $len; $i++) {
            // $result = $arr[$i];
            $aid = (int)$arr[$i];
            $result = mysqli_query($link, "insert into `notices`(`title`, `notice`, `starttime`, `endtime`, `aid`, `time`) VALUES ('$title','$text','$starttime','$endtime','$aid','$time')");
            // echo json_encode([(int)$arr[$i]]);
        }
    }
    // $result = mysqli_query($link, "insert into `notices`(`title`, `notice`, `starttime`, `endtime`, `aid`, `time`) 
    // VALUES ('$title','$starttime','endtime',$text','$aid','$time')");
    // echo json_encode(['a' => $time,'b' => $result]);
    // $a = explode(',', $aids,strlen($aids));
    // $st = 0;
    // if ($result) {
        $st = 1;
    // }
    echo json_encode(['status' => $st, 'c' => $result]);
?>