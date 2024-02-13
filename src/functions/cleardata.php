<?php
if (!isset($INTERGITY_CHECK)) {
    header("Location: /");
    exit();
}
$_SESSION['user_data'] = [
    'kv' => [],
    'story' => []
];
# if headers are already sent, do meta refresh
if (headers_sent()) {
    echo '<meta http-equiv="refresh" content="0;url=/" />';
    exit();
} else {
    header('Location: /');
    exit();
}
