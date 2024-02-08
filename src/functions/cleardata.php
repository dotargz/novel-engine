<?php
if (!isset($INTERGITY_CHECK)) {
    header("Location: /");
    exit();
}
session_start();
$_SESSION['user_data'] = [
    'kv' => [],
    'story' => []
];
header('Location: /');
?>
