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
                    <label for="songName" class="h5">Mã lớp học phần</label>
                    <select class="form-select" name="ID_DSMH">
                        <?php
                        foreach ($data["lhp"] as $index => $datum) {
                            echo <<<HUH
                            <option value="{$datum["ID"]}">{$datum["ID"]}</option>
                            HUH;
                        }
                        ?>
                    </select>
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Tiết bắt đầu</label>
                    <input type="number" name="TIET_BAT_DAU" class="form-control flex-fill mb-0"
                           placeholder="Tiết bắt đầu" id="songName" value="<?php
                    if (isset($data["tkb"])) {
                        echo $data["tkb"]["TIET_BAT_DAU"];
                    }

                    ?>">
                </div>


                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Tiết kết thúc</label>
                    <input type="number" name="TIET_KET_THUC" class="form-control flex-fill mb-0"
                           placeholder="Tiết kết thúc" id="songName" value="<?php
                    if (isset($data["tkb"])) {
                        echo $data["tkb"]["TIET_KET_THUC"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Lớp</label>
                    <input type="text" name="LOP" class="form-control flex-fill mb-0"
                           placeholder="Lớp" id="songName" value="<?php
                    if (isset($data["tkb"])) {
                        echo $data["tkb"]["LOP"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Thứ</label>
                    <input type="text" name="THU" class="form-control flex-fill mb-0"
                           placeholder="Thứ" id="songName" value="<?php
                    if (isset($data["tkb"])) {
                        echo $data["tkb"]["THU"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Tuần Học</label>
                    <input type="text" name="TUANHOC" class="form-control flex-fill mb-0"
                           placeholder="Tuần Học" id="songName" value="<?php
                    if (isset($data["tkb"])) {
                        echo $data["tkb"]["TUANHOC"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Mã giáo viên</label>
                    <select class="form-select" name="ID_GVGD">
                        <?php
                        foreach ($data["gv"] as $index => $datum) {
                            echo <<<HUH
                            <option value="{$datum["ID"]}">{$datum["ID"]}</option>
                            HUH;
                        }
                        ?>
                    </select>
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Học kỳ</label>
                    <input type="number" name="HK" class="form-control flex-fill mb-0"
                           placeholder="Học kỳ" id="songName" value="<?php
                    if (isset($data["tkb"])) {
                        echo $data["tkb"]["HK"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Năm học</label>
                    <input type="number" name="NAM" class="form-control flex-fill mb-0"
                           placeholder="Năm học" id="songName" value="<?php
                    if (isset($data["tkb"])) {
                        echo $data["tkb"]["NAM"];
                    }

                    ?>">
                </div>


                <div class="d-flex justify-content-center gap-1">
                    <button type="submit" class="btn btn-primary text-break mt-5" style="width: 100%">Xác nhận</button>
                    <button class="btn btn-secondary text-break mt-5" style="width: 100%">Thoát</button>
                </div>
            </form>
        </section>
    </div>
</div>
