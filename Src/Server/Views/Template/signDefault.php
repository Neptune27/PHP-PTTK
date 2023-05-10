<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>



    <link rel="stylesheet" href=/Bootstrap/css/bootstrap.min.css>
    <script src="/Bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="/Src/Client/css/Login.css">

</head>

<body class="gradient p-4 loginMain" style="min-height: 100vh; padding-bottom: 0">


<?php
if (isset($data["Page"])) {
    require_once __DIR__."/../".$data["View"].$data["Page"].".php";
}
?>

</body>
