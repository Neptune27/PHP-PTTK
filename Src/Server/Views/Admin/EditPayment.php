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
                    <label for="songName" class="h5">Mã thanh toán</label>
                    <input type="text" name="ID" class="form-control flex-fill mb-0"
                           placeholder="Mã thanh toán" id="songName" value="<?php
                    if (isset($data["pm"])) {
                        echo $data["pm"]["ID"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Mã sinh viên</label>
                    <input type="text" name="MSSV" class="form-control flex-fill mb-0"
                           placeholder="Mã sinh viên" id="songName" value="<?php
                    if (isset($data["pm"])) {
                        echo $data["pm"]["MSSV"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Tiền học phí</label>
                    <input type="text" name="TIEN_HOC_PHI" class="form-control flex-fill mb-0"
                           placeholder="Tiền học phí" id="songName" value="<?php
                    if (isset($data["pm"])) {
                        echo $data["pm"]["TIEN_HOC_PHI"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Tổng tín chỉ</label>
                    <input type="text" name="TONG_TIN_CHI" class="form-control flex-fill mb-0"
                           placeholder="Tổng tín chỉ" id="songName" value="<?php
                    if (isset($data["pm"])) {
                        echo $data["pm"]["TONG_TIN_CHI"];
                    }

                    ?>">
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Mã hình thức</label>
                    <select class="form-select" name="ID_HINH_THUC">
                        <option value="1">Chuyển khoản</option>
                        <option value="2">Trực tiếp</option>
                        <option value="3">Học bổng</option>
                    </select>
                </div>

                <div class="mt-4 has-validation">
                    <label for="songName" class="h5">Mã trạng thái</label>
                    <select class="form-select" name="ID_TRANG_THAI">
                        <option value="1">Đang xử lý</option>
                        <option value="2">Hủy</option>
                        <option value="3">Xác nhận</option>
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
