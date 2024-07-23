<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!function_exists("protect")) {
    function protect($admin)
    {
        if (!isset($_SESSION['user_id'])) {
            die("<script>location.href='login.php';</script>");
        }

        if ($admin == 1 && $_SESSION['user_adm'] != 1) {
            die("<script>location.href='login.php';</script>");
        }
    }
}