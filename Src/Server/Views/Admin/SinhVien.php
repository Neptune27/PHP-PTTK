<?php
    if (!isset($data)) {
        $data = [];
    }
?>
<h1 class="text-center p-4 fw-bold">Sinh Viên</h1>

<div class="d-flex gap-2 p-2 justify-content-end">

    <a class="btn btn-primary" href="/Admin/EditSinhVien">Thêm sinh viên</a>

    <form class="m-0" action="<?php echo '/' . htmlspecialchars($_GET['url']); ?>">

        <div class="input-group">
            <input type="text" class="form-control" value="<?php
            if (isset($_GET["q"])) {
                echo $_GET["q"];
            }
            ?>" placeholder="Tìm kiếm" name="q">
            <button class="btn btn-secondary" type="submit" id="button-addon2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </div>
    </form>
</div>
<div style="width: 100%; margin: auto">
    <div>
        <div style="padding: 2rem 0">

            <div class="loginMain d-flex flex-column align-items-center">
                <div class="loginContent">
                    <section class="m-auto bg-white p-4 rounded-4 text-dark">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Mã sinh viên</th>
                                <th scope="col">Tên sinh viên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Mã lớp</th>
                                <th scope="col">Năm bắt đầu</th>
                                <th scope="col">Số thẻ ngân hàng</th>
                                <th scope="col">Mật khẩu</th>
                                <th scope="col">Chỉnh sửa</th>
                                <th scope="col">Xóa</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            foreach ($data["data"] as $index => $datum) {
                                $edit = "";
                                $delete = "";
                                $reset = <<<wut
                                    <a href="/Admin/ResetSinhVien/{$datum["MSSV"]}" class="btn btn-primary">Đặt lại</a>
                                wut;
                                $edit = <<<wut
                                    <a href="/Admin/EditSinhVien/{$datum["MSSV"]}" class="btn btn-primary">Chỉnh</a>
                                wut;
                                if ($datum["CAN_DELETE"] == 1) {
                                    $delete = <<<wut
                                    <a href="/Admin/DeleteSinhVien/{$datum["MSSV"]}" class="btn btn-danger">Xóa</a>
                                wut;
                                }
                                echo <<<JIT
                            <tr>
                                <th scope="row">{$datum["MSSV"]}</th>
                                <td>{$datum["HO_TEN"]}</td>
                                <td>{$datum["EMAIL"]}</td>
                                <td>{$datum["PHONE"]}</td>
                                <td>{$datum["ID_LOP"]}</td>
                                <td>{$datum["NAM_BAT_DAU"]}</td>
                                <td>{$datum["SO_THE_NH"]}</td>
                                <td>{$reset}</td>
                                <td>{$edit}</td>
                                <td>{$delete}</td>
                            </tr>
                            JIT;

                            }

                            ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>


        </div>
    </div>
</div>
