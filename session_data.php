<?php
    session_start();

    echo "User ".$_SESSION["username"]." is logged in!<BR>";
    echo "User ".$_SESSION["username"]." "."is logged in as a ".$_SESSION['login_type'].".<BR>";

    // exit();

?>