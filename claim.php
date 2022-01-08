<?php
    $room = $_POST['room'];

    // Checking string size
    if(strlen($room)>20 OR strlen($room)<2) {
        $message = "Please choose Room name between 2 to 20 characters.";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="index.php";';
        echo '</script>';
    }
    // To check if the room name is alphanumeric or not
    else if(!ctype_alnum($room)) {
        $message = "Please enter alphanumeric Room name.";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="index.php";';
        echo '</script>';
    }
    else {
        // Connecting to the DB
        include 'db_connect.php';
    }

    // Check if room already exist
    $sql = "SELECT * FROM `rooms` WHERE roomname = '$room';";
    $result = mysqli_query($conn,$sql);
    if ($result) {
        if (mysqli_num_rows($result)>0) { // returns number of rows
            $message = "Please choose different Room name.This room is already claimed";
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="index.php";';
            echo '</script>';
        }
        else {
            $sql = "INSERT INTO `rooms` (`roomname`, `stime`) VALUES ('$room',CURRENT_TIMESTAMP);";
            if (mysqli_query($conn,$sql)) {
                $message = "Your Room is ready and you can chat now!";
                echo '<script language="javascript">';
                echo 'alert("'.$message.'");';
                echo 'window.location="rooms.php?roomname=' . $room . '";';
                echo '</script>';
            } 
        }
    }
    else {
        echo "Error: " . mysql_error($conn); 
    }
?>