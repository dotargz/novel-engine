<?php
if (!isset($INTERGITY_CHECK)) {
    header("Location: /");
    exit();
}

session_start();
if (!isset($_SESSION['user_data'])) {
    $_SESSION['user_data'] = [];
}
if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'default';
}

$softwareVersion = 'v1.1.0-stable';
$showVersion = false;

include_once $_SERVER['DOCUMENT_ROOT'] . '/functions/functions.php';
?>
