<?php
session_start();
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_type = $_POST['login_type']; 
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    if ($login_type == "admin") {
        $table = 'admin';
        $sql = "SELECT * FROM $table WHERE admin_id = '$userid' and admin_password = '$password'";
        $result = mysqli_query($conn, $sql);
    }
    elseif ($login_type == "member") {
        $table = 'member';
        $sql = "SELECT * FROM $table WHERE member_id = '$userid' and member_password = '$password'";
        $result = mysqli_query($conn, $sql);
    }

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result); 
        if ($login_type == "admin") {
            $username = $row["a_first_name"];
        } else {
            $username = $row["first_name"];
        }

        $_SESSION['loggedin'] = true;
        $_SESSION['userid'] = $userid;
        $_SESSION['username'] = $username;
        $_SESSION['login_type'] = $login_type;       
        // echo "login Successful<BR>";
        // echo "The user ".$_SESSION["username"]." "."is logged in as ".$_SESSION['login_type'];

        if ($_SESSION["login_type"] == "admin") {
            echo "
                <script>
                    alert('Admin Log in Successful.');
                </script>
            ";
            header("Location: ./admin_dash.php");
        } else if ($_SESSION["login_type"] == "member") {
            echo "
                <script>
                    alert('Member Log in Successful.');
                </script>
            ";
            header("Location: ./member_dash.php");
        }
        exit();
    }
    else {
        echo "login failed";
        exit();
    }
}

$conn->close();