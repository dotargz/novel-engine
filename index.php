<?php
# session is started in autoimport.php
$INTERGITY_CHECK = true;
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/functions/autoimport.php';

if (!isset($_SESSION['user_data']['story']['currentPage'])) {
    $_SESSION['user_data']['story']['currentPage'] = 'beginning';
}

# interpret the option if it is set
if (isset($_GET['option'])) {
    runActionFromPage($_SESSION['user_data']['story']['currentPage'], $_GET['option']);
}

if (isset($_GET['reset'])) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/src/functions/cleardata.php';
    exit();
}

$page = getStory($_SESSION['user_data']['story']['currentPage']);
$title = $_SESSION['user_data']['story']['currentPage'];

# set the theme according to the $page['theme'] value
if (isset($page['theme'])) {
    # if the name of the theme is in the css/themes/ directory
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/public/css/themes/' . $page['theme'] . '.css')) {
        $_SESSION['theme'] = $page['theme'];
    } else {
        $_SESSION['theme'] = 'default';
    }
} else {
    $_SESSION['theme'] = 'default';
}

include $_SERVER['DOCUMENT_ROOT'] . '/src/components/header.php';
?>
<span class="page-id">
    <?php echo $title; ?>
</span>
<h1>
    <?php echo $page['heading']; ?>
</h1>
<p>
    <?php echo $page['text']; ?>
</p>
<div class="options">
    <?php
    foreach (validOptions($page['options']) as $optionName => $option) {
        # Use $optionName as the key to get the action
        echo "<a class='btn' href='/?option=" . $optionName . "'>" . parseText($option['text']) . "</a>";
    }
    ?>
    <div class="settings">
        <a href="/?reset" class="btn reset"><i class="fas fa-trash-alt"></i></a>
    </div>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/components/footer.php';
?>
