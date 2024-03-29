<?php
if (!isset($INTERGITY_CHECK)) {
    header("Location: /");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title; ?> ~ Novel Engine
    </title>

    <script src="https://unpkg.com/swup@4"></script>
    <script src="https://unpkg.com/@swup/head-plugin@2"></script>
    <script>
        const swup = new Swup({
            plugins: [new SwupHeadPlugin({
                awaitAssets: true,
                persistTags: 'script[src], style'
            })]
        });
    </script>


    <script src="https://kit.fontawesome.com/9cb2f2488a.js" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="public/css/themes/<?php echo $_SESSION['theme']; ?>.css">
    <link rel="stylesheet" href="public/css/global.css">

</head>

</div>

<body>
    <div id="swup" class="container transition-fade">
