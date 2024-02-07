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
    echo '<a href="https://github.com/dotargz/novel-engine/" target="_blank">Novel Engine</a> ' . $softwareVersion . ' running on ' . $_SERVER['SERVER_SOFTWARE'];
    echo '</span>';
}
?>
</body>
</html>
