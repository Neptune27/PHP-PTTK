<?php
    if (!isset($data)) {
        $data=[];
    }
//    print_r($data["Albums"]);
?>

<div class="resGrid" style="padding: 1rem">
    <?php
    if (isset($data["Albums"])) {
        $uri = $_GET["url"];
        foreach ($data["Albums"] as $index => $datum) {
            ["ALBUM_ID" => $ID, "ALBUM_NAME"=>$name, "ALBUM_IMG"=>$image] = $datum;
            echo <<<WUT
                    <a href="/{$uri}/{$ID}" class="card shadow p-3 bg-white rounded cardItem" style="max-height: 200px">
                        <div>
                            <img class="card-img-top" src="{$image} " alt="Cover" style=" background-position: center; max-height: 100px; object-fit: cover;">
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <h5 class="card-title">{$name}</h5>
                        </div>
                    </a>
                WUT;
        }
    }
    ?>


</div>
