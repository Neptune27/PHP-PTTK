<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta charset='utf-8'>

    <link rel="stylesheet" href="/Bootstrap/css/bootstrap.min.css">

    <script src="/Bootstrap/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="/Src/Client/css/GlobalStyle.css">
    <link rel="stylesheet" href="/Src/Client/css/NavBar.css">

</head>
<style>
    .loginContent {
        width: 80%;
    }
</style>

<body style="margin: 0">
<?php
require_once __DIR__."/_header.php";
?>
<main style="min-height: 100vh; position: relative;">
    <div class="gradient" style="position: absolute; height: 100%; width: 100%; z-index: -2"></div>

    <div style="padding: 2rem 0">
        <?php
        if (isset($data["Page"])) {
            require_once __DIR__ . "/../../" . $data["View"] . $data["Page"] . ".php";
        }
        ?>
    </div>

</main>

</body>
</html>
