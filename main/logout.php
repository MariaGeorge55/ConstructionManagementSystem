<?php
session_start();
if(isset($_SESSION['username']))
                {
 unset($_SESSION['username']);
    }
session_unset();
session_destroy();
header("Location:mainlogin.php");
?>
