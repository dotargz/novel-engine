<?php
if (!isset($INTERGITY_CHECK)) {
    header("Location: /");
    exit();
}

session_start();
if (!isset($_SESSION['user_data'])) {
    $_SESSION['user_data'] = [
        'kv' => [],
        'story' => []
    ];
}
if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'default';
}

$softwareVersion = 'v1.3.0-dev';

if (strpos($softwareVersion, '-dev') !== false) {
    $showVersion = true;
} else {
    $showVersion = false;
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/src/functions/functions.php';
