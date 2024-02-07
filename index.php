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

if (isset($_GET['next-theme'])) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/src/functions/themecycle.php';
    exit();
}

$page = getStory($_SESSION['user_data']['story']['currentPage']);
$title = $_SESSION['user_data']['story']['currentPage'];

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
        echo "<a href='/?option=" . $optionName . "'>" . parseText($option['text']) . "</a>";
    }
    ?>
    <div class="settings">
    <a href="/?reset" class="btn reset"><i class="fas fa-trash-alt"></i></a>
        <a href="/?next-theme" class="btn theme"><i class="fas fa-adjust"></i></a>

    </div>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/components/footer.php';
?>

