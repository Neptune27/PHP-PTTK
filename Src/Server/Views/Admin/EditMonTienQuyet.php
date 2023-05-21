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
                    <select class="form-select" name="ID_MON_HOC">
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
                    <label for="songName" class="h5">Mã môn tiên quyết</label>
                    <select class="form-select" name="ID_MON_HOC_TRUOC">
                        <?php
                        foreach ($data["monTruoc"] as $index => $datum) {
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
