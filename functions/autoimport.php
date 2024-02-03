<?php
session_start();
if (!isset($_SESSION['user_data'])) {
    $_SESSION['user_data'] = [];
}
if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'default';
}

include_once 'functions.php';
?>
