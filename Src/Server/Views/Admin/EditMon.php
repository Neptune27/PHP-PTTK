<?php
if (!isset($data)) {
    $data = [];
}
?>

<div class="loginMain d-flex flex-column align-items-center">
    <div class="loginContent">
        <section class="m-auto bg-white rounded-4 text-dark">
            <h1 class="text-center p-4 fw-bold"><?php
                echo $data["Title"];
                ?></h1>
            <form id="signInForm" class="p-4 needs-validation">

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Mã môn</label>
                    <input type="text" name="ID" class="form-control flex-fill mb-0"
                           placeholder="Mã môn" id="songName" value="<?php
                        if (isset($data["mon"])) {
                            echo $data["mon"]["ID"];
                        }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Tên môn</label>
                    <input type="text" name="TEN" class="form-control flex-fill mb-0"
                           placeholder="Tên môn" id="songName" value="<?php
                    if (isset($data["mon"])) {
                        echo $data["mon"]["TEN"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Tín chỉ</label>
                    <input type="number" name="TIN_CHI" class="form-control flex-fill mb-0"
                           placeholder="Tín chỉ" id="songName" value="<?php
                    if (isset($data["mon"])) {
                        echo $data["mon"]["TIN_CHI"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Mã ngành</label>
                    <select class="form-select" name="ID_NGANH">
                        <?php
                        foreach ($data["nganh"] as $index => $datum) {
                            echo <<<HUH
                            <option value="{$datum["ID"]}">{$datum["ID"]}</option>
                            HUH;
                        }
                        ?>
                    </select>
                </div>

                <div class="d-flex justify-content-center gap-1">
                    <button type="submit" class="btn btn-primary text-break mt-5" style="width: 100%">Xác nhận</button>
                    <button class="btn btn-secondary text-break mt-5" style="width: 100%">Thoát</button>
                </div>
            </form>
        </section>
    </div>
</div>
