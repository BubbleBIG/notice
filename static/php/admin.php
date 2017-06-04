<?php
    require_once ('connect.php');
    header("Content-type: text/html; charset=utf-8");
    $aid = $_POST['aid'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $time = Date('Y-m-d');
    // $time = time();
    $result = mysqli_query($link, "insert into `notices`(`title`,`notice`, `aid`, `time`) VALUES ('$title','$text','$aid','$time')");
    echo json_encode(['a' => $time,'b' => $result]);
?>