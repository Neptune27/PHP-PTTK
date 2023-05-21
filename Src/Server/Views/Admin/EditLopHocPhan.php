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
                    <select class="form-select" name="ID_MONHOC">
                        <?php
                        foreach ($data["mon"] as $index => $datum) {
                            echo <<<HUH
                            <option value="{$datum["ID"]}">{$datum["ID"]}</option>
                            HUH;
                        }
                        ?>
                    </select>
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Nhóm</label>
                    <input type="number" name="NHOM" class="form-control flex-fill mb-0"
                           placeholder="Nhóm" id="songName" value="<?php
                    if (isset($data["lhp"])) {
                        echo $data["lhp"]["NHOM"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Số lượng</label>
                    <input type="number" name="SL_SV" class="form-control flex-fill mb-0"
                           placeholder="Số lượng" id="songName" value="<?php
                    if (isset($data["lhp"])) {
                        echo $data["lhp"]["SL_SV"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Học kỳ</label>
                    <input type="number" name="HOC_KY" class="form-control flex-fill mb-0"
                           placeholder="Học kỳ" id="songName" value="<?php
                    if (isset($data["lhp"])) {
                        echo $data["lhp"]["HOC_KY"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Năm học</label>
                    <input type="number" name="NAM_HOC" class="form-control flex-fill mb-0"
                           placeholder="Năm học" id="songName" value="<?php
                    if (isset($data["lhp"])) {
                        echo $data["lhp"]["NAM_HOC"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Ngày bắt đầu</label>
                    <input type="date" name="NGAY_BAT_DAU" class="form-control flex-fill mb-0"
                           placeholder="Năm học" id="songName" value="<?php
                    if (isset($data["lhp"])) {
                        echo $data["lhp"]["NGAY_BAT_DAU"];
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
