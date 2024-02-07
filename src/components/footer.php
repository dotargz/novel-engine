<?php
if (!isset($INTERGITY_CHECK)) {
    header("Location: /");
    exit();
}
?>
</div>
<?php
if ($showVersion) {
    echo '<span class="software-version">';
    echo 'novel engine ' . $softwareVersion . ' running on ' . $_SERVER['SERVER_SOFTWARE'];
    echo '</span>';
}
?>
</body>
</html>
