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
                    <label for="songName" class="h5">Mã sinh viên</label>
                    <input type="text" name="MSSV" class="form-control flex-fill mb-0"
                           placeholder="Mã sinh viên" id="songName" value="<?php
                        if (isset($data["sinhVien"])) {
                            echo $data["sinhVien"]["MSSV"];
                        }

                    ?>" readonly>
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Tên sinh viên</label>
                    <input type="text" name="HO_TEN" class="form-control flex-fill mb-0"
                           placeholder="Tên sinh viên" id="songName" value="<?php
                    if (isset($data["sinhVien"])) {
                        echo $data["sinhVien"]["HO_TEN"];
                    }

                    ?>" readonly>
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Email</label>
                    <input type="text" name="EMAIL" class="form-control flex-fill mb-0"
                           placeholder="Email" id="songName" value="<?php
                    if (isset($data["sinhVien"])) {
                        echo $data["sinhVien"]["EMAIL"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Số điện thoại</label>
                    <input type="text" name="PHONE" class="form-control flex-fill mb-0"
                           placeholder="Số điện thoại" id="songName" value="<?php
                    if (isset($data["sinhVien"])) {
                        echo $data["sinhVien"]["PHONE"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Năm bắt đầu</label>
                    <input type="number" name="NAM_BAT_DAU" class="form-control flex-fill mb-0"
                           placeholder="Năm bắt đầu" id="songName" value="<?php
                    if (isset($data["sinhVien"])) {
                        echo $data["sinhVien"]["NAM_BAT_DAU"];
                    }

                    ?>" readonly>
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Số thẻ ngân hàng</label>
                    <input type="number" name="SO_THE_NH" class="form-control flex-fill mb-0"
                           placeholder="Số thẻ ngân hàng" id="songName" value="<?php
                    if (isset($data["sinhVien"])) {
                        echo $data["sinhVien"]["SO_THE_NH"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Mã lớp</label>
                    <select class="form-select" name="ID_LOP">
                        <?php
                        foreach ($data["lop"] as $index => $datum) {
                            echo <<<HUH
                            <option value="{$datum["ID"]}">{$datum["ID"]}</option>
                            HUH;
                        }
                        ?>
                    </select readonly>
                </div>

                <div class="d-flex justify-content-center gap-1">
                    <button type="submit" class="btn btn-primary text-break mt-5" style="width: 100%">Xác nhận</button>
                    <button class="btn btn-secondary text-break mt-5" style="width: 100%">Thoát</button>
                </div>
            </form>
        </section>
    </div>
</div>
