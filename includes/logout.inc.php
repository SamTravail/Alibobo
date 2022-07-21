<?php

$_SESSION['login'] = false;
session_destroy();

echo "<script>window.location.replace('http://localhost/alibobo/DWWM-Vernon-2022-PHP-Alibobo/index.php?page=accueil')</script>";
