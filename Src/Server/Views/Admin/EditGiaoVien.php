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
                    <label for="songName" class="h5">Mã giáo viên</label>
                    <input type="text" name="ID" class="form-control flex-fill mb-0"
                           placeholder="Mã giáo viên" id="songName" value="<?php
                        if (isset($data["giaoVien"])) {
                            echo $data["giaoVien"]["ID"];
                        }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Tên giáo viên</label>
                    <input type="text" name="TEN" class="form-control flex-fill mb-0"
                           placeholder="Tên giáo viên" id="songName" value="<?php
                    if (isset($data["giaoVien"])) {
                        echo $data["giaoVien"]["TEN"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Email</label>
                    <input type="text" name="EMAIL" class="form-control flex-fill mb-0"
                           placeholder="Email" id="songName" value="<?php
                    if (isset($data["giaoVien"])) {
                        echo $data["giaoVien"]["EMAIL"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Số điện thoại</label>
                    <input type="text" name="PHONE" class="form-control flex-fill mb-0"
                           placeholder="Số điện thoại" id="songName" value="<?php
                    if (isset($data["giaoVien"])) {
                        echo $data["giaoVien"]["PHONE"];
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

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Mã chức vụ</label>
                    <select class="form-select" name="ID_CHUC_VU">
                        <?php
                        foreach ($data["cv"] as $index => $datum) {
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
