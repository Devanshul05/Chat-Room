<?php
    include 'db_connect.php';

    $msg = $_POST['text'];
    $room = $_POST['room'];
    $name = $_POST['name'];
    $ip = $_POST['ip'];

    $sql = "INSERT INTO `msgs` (`msg`, `name`, `room`, `ip`, `stime`) VALUES ('$msg', '$name', '$room', '$ip', CURRENT_TIMESTAMP);";
    mysqli_query($conn,$sql);
    mysqli_close($conn);
?>