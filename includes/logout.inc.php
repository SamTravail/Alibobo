<?php

$_SESSION['login'] = false;
session_destroy();

echo "<script>window.location.replace('http://localhost:8080/DWWM-Vernon-2022-PHP-Alibobo/')</script>";
