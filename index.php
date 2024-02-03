<?php
# session is started in autoimport.php
include_once $_SERVER['DOCUMENT_ROOT'] . '/functions/autoimport.php';

if (!isset($_SESSION['user_data']['story']['currentPage'])) {
    $_SESSION['user_data']['story']['currentPage'] = 'beginning';
}

# interpret the option if it is set
if (isset($_GET['option'])) {
    runActionFromPage($_SESSION['user_data']['story']['currentPage'], $_GET['option']);
}

$page = getStory($_SESSION['user_data']['story']['currentPage']);
$title = $_SESSION['user_data']['story']['currentPage'];

include 'components/header.php';
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
    <a href="/functions/cleardata.php" class="btn reset"><i class="fas fa-trash-alt"></i></a>
        <a href="/functions/themecycle.php" class="btn theme"><i class="fas fa-adjust"></i></a>

    </div>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/components/footer.php';
?>

