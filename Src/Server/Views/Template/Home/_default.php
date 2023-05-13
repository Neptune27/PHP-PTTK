<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta charset='utf-8'>

    <link rel="stylesheet" href="/Bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css" rel="stylesheet"
          type="text/css"/>

    <script src="/Bootstrap/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="/Src/Client/css/GlobalStyle.css">
    <link rel="stylesheet" href="/Src/Client/css/NavBar.css">
<!--    <link rel="stylesheet" href="/Src/Client/css/User/UserOverview.css">-->


</head>
<body style="margin: 0">
<?php
    require_once __DIR__."/_header.php"
?>

<style>
    .main {
        padding-top: 1rem;
        width: 60%;
        margin-inline: auto;
    }
    @media (width < 800px) {
        .main {
            width: 100%;
        }
    }

    @media (width < 1000px) and (width > 800px){
        .main {
            width: 80%;
        }
    }

</style>
<main class="main" style="position: relative;">
    <?php
    if (isset($data["Page"])) {
        require_once __DIR__."/../../".$data["View"].$data["Page"].".php";
    }
    ?>
</main>

</body>
</html>
