<?php
    $roomname = $_GET['roomname'];

    include 'db_connect.php';

    $sql = "SELECT * FROM `rooms` WHERE roomname = '$roomname';";

    $result = mysqli_query($conn,$sql);

    if ($result) {
        if (mysqli_num_rows($result)==0) {
            $message = "This room does not exist. Try creating a new one.";
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="rooms.php?roomname=' . $room . '";';
            echo '</script>';
        }
    }
    else {
        echo "Error: " . mysqli_error($conn);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="rooms.css">
</head>
<body onload="myFunction()">

    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
        <a href="index.php" class="d-flex align-items-center text-dark text-decoration-none">
            <span class="fs-4" id="nav-chat">Chat Room</span>
        </a>

        <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
            <a class="me-3 py-2 text-dark text-decoration-none" id="nav-logout" href="index.php">Logout</a>
        </nav>
    </div>

    <h2>Chat Room - <?php echo $roomname; ?></h2>

    <div class="main-box">
        <div class="main-content">
            <div class="container">
                <div class="anyClass">
            
                </div>
            </div>

            <span>
                <input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Add message" required>
                <button name="submitmsg" id="submitmsg"><b>SEND</b></button>
            </span>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        var name = "";
        function myFunction() {
            name = prompt("Please Enter your Name");
        };
        // Check for new messages every 1 second
        setInterval(runFunction,1000);
        function runFunction() {
            $.post("htcont.php", {names: name, room: '<?php echo $roomname ?>'},
                function (data, status) {
                    document.getElementsByClassName('anyClass')[0].innerHTML = data;
                }
            );
        }

        // Submit with enter button
        document.getElementById("usermsg")
        .addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("submitmsg").click();
        }
    });

        // If user submits a form
        $("#submitmsg").click(function() {
            var clientmsg = $("#usermsg").val();
            $.post("postmsg.php",{name: name, text: clientmsg, room: '<?php echo $roomname ?>', ip: '<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
            function(data, status) {
                document.getElementsByClassName('anyClass')[0].innerHTML = data;
            });

            window.onload = myFunction;

            // Empty text after submit
            $("#usermsg").val("");
            return false;
        });
    </script>

</body>
</html>