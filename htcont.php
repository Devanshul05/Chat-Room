<?php
    include 'db_connect.php';

    $room = $_POST['room'];
    $name = $_POST['names'];
    $sql = "SELECT `msg`, `name`, `stime`, `ip` FROM `msgs` WHERE room = '$room';";
    
    $res = "";
    $result = mysqli_query($conn,$sql);
    
    if (mysqli_num_rows($result)>0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $res = $res . '<div class="container" style="color: black; background-color: #bdbdbd">';
            $res = $res . '<b>' . strtoupper($row['name']) . '</b>';
            $res = $res . '<p style="font-size: 17px">' . $row['msg'];
            $res = $res . '</p> <span class="time-right" style="color: black;">' . $row["stime"] . '</span></div>';
        }
    }
    echo $res;
?>