<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta charset='utf-8'>

    <script
        src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>


    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet"/>

    <link rel="stylesheet" href="/Bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css" rel="stylesheet"
          type="text/css"/>

    <script src="/Bootstrap/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="/Src/Client/css/GlobalStyle.css">
    <link rel="stylesheet" href="/Src/Client/css/Admin/AdminHeader.css">
    <link rel="stylesheet" href="/Src/Client/css/ResGrid.css">
    <link rel="stylesheet" href="/Src/Client/css/User/UserOverview.css">
    <link rel="stylesheet" href="/Src/Client/css/Breadcrumb.css">


    <style>
        .filepond--root {
            height: 6rem;
        }

        .filepond--credits {
            display: none;
        }
    </style>
</head>
<body style="margin: 0">
<header>
    <div class="header-content" style="z-index: 10;">

        <a href="#" class="logo">Spotify No Budget</a>

        <input type="checkbox" id="hamburger" aria-label="menu button">
        <label for="hamburger"><span></span></label>

        <nav aria-label="main navigation">
            <ul class="menus" style="z-index: 10">
                <li><a href="/Admin">Home</a></li>
                <li>
                    <a href="/Admin/AddSongPage"
                       type="button"
                       aria-haspopup="true"
                       aria-expanded="true"
                       aria-controls="dropdown1"
                    >
                        Bài hát
                    </a>
                </li>
<!--                <li>-->
<!--                    <button-->
<!--                            type="button"-->
<!--                            aria-haspopup="true"-->
<!--                            aria-expanded="true"-->
<!--                            aria-controls="dropdown2"-->
<!--                    >-->
<!--                        Song<span class="arrow"></span>-->
<!--                    </button>-->
<!--                    <ul class="dropdown" id="dropdown2">-->
<!--                        <li><a href="/Admin/AddSongPage">Xem tất cả</a></li>-->
<!--                        <li><a href="#">Thêm</a></li>-->
<!--                        <li><a href="#">Sửa</a></li>-->
<!--                        <li><a href="#">Xóa</a></li>-->
<!--                    </ul>-->
<!--                </li>-->


            </ul>
        </nav>
    </div>
</header>
<main style="min-height: 100vh; position: relative;">
    <div class="gradient" style="position: absolute; height: 100%; width: 100%; z-index: -2"></div>


    <div style="padding: 2rem 0">


        <h1 class="display-3 d-flex justify-content-center " style="font-weight: bold; color: white"><?php
            if (!isset($data["Title"])) {
                $data["Title"] = "Title attribute missing!";
            }
            echo $data["Title"];
            ?></h1>

        <div class="d-flex justify-content-between p-3 align-items-center" style="flex-wrap: wrap">
            <?php


            echo '<ol class="d-flex flex-wrap arrows">';
            echo '<li><a href="/Admin">Home</a></li>';
            if ($data["Title"] !== "Ca Sĩ") {
                if (isset($data["artist"][0])) {
                    [
                        "USER_ID" => $userID, "NAME" => $artistName,
                    ] = $data["artist"][0];
                    echo <<<HUH
                    <li><a href="/Admin/AddSongPage/{$userID}">{$artistName}</a></li>
                    HUH;
                }
                if ($data["Title"] !== "Albums")
                if (isset($data["Albums"][0])) {

                    [
                        "ALBUM_ID" => $albumID, "ALBUM_NAME" => $albumName,
                    ] = $data["Albums"][0];

                    echo <<<HUH
                    <li><a href="/Admin/AddSongPage/{$userID}/{$albumID}">{$albumName}</a></li>
                    HUH;

                }

            }

            echo '</ol>';
            ?>


            <div class="d-flex gap-2">
                <div>
                    <a href="<?php
//                    Chuyen huong sang trang them ca si neu title la ca si
                                if ($data["Title"] == "Ca Sĩ") {
                                    echo "/Admin/AddArtist";
                                } else {
                                    echo '/' . htmlspecialchars($_GET['url']) . '/0';
                                }
                    ?>" class="btn btn-primary">Thêm
                        <?php echo $data["Title"] ?></a>
                </div>

                <form action="<?php echo '/' . htmlspecialchars($_GET['url']); ?>">

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="<?php
                        if (isset($data["query"])) {
                            echo $data["query"];
                        }
                        ?>" placeholder="Tìm kiếm" name="q">
                        <button class="btn btn-secondary" type="submit" id="button-addon2">
                            <i class="fa fa-regular fa-search"></i>
                        </button>
                    </div>

                </form>

            </div>

        </div>


        <?php
        if (isset($data["Page"])) {
            require_once __DIR__ . "/../../" . $data["View"] . $data["Page"] . ".php";
        }
        ?>
    </div>

</main>

</body>
</html>
