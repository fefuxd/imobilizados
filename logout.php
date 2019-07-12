<?php

    session_start();
    unset($_SESSION["IDUSER"]);
    header("location:index.php");

?>