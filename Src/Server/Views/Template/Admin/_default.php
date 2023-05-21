<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta charset='utf-8'>

    <link rel="stylesheet" href="/Bootstrap/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"
          type="text/css"/>

    <script src="/Bootstrap/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="/Src/Client/css/GlobalStyle.css">
    <link rel="stylesheet" href="/Src/Client/css/NavBar.css">
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>
<style>
    .loginContent {
        width: 80%;
    }
</style>
<body style="margin: 0">
<?php
require_once __DIR__."/_Header.php";
?>
<main style="position: relative">

    <div style="padding: 2rem">
        <?php
        if (isset($data["Page"])) {
            require_once __DIR__ . "/../../" . $data["View"] . $data["Page"] . ".php";
        }
        ?>
    </div>

</main>

</body>
</html>
