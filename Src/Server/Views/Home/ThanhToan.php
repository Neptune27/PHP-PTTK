<!DOCTYPE html>
<html>

<head>
    <title>Thanh toán</title>
    <style>
        /* Thêm CSS cho giao diện thanh toán */
        .payment-container {
            width: 400px;
            border: 1px solid #ccc;
            border-radius: 8px;
            text-align: left;
            margin: 0 auto;
            margin-top: 20px;
            padding: 20px;
        }

        /* CSS cho chatbox */
        .chatbox-container {
            margin-top: 20px;
            display: none;
        }

        /* CSS cho các nút */
        .button-container {
            margin-top: 20px;
        }

        /* CSS ẩn bảng, tổng số tín chỉ và tổng số học phí */
        .hidden-table,
        .hidden-total-credits,
        .hidden-total-fee {
            display: none;
        }
    </style>

</head>

<body>
    <div class="table-responsive">
        <table class="table table-hover table-bordered hidden-table"> <!-- Thêm lớp CSS hidden-table -->
            <thead>
                <tr>
                    <th scope="col">Mã môn học</th>
                    <th scope="col">Tên môn học</th>
                    <th scope="col">Số tín chỉ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalCredits = 0;
                foreach ($data["DSMH"] as $index => $datum) {
                    $totalCredits += $datum["TINCHI"];
                    echo <<<WUT
                <tr>
                    <td>{$datum["MMH"]}</td>
                    <td>{$datum["TENMH"]}</td>
                    <td id="credit">{$datum["TINCHI"]}</td>
                </tr>
                WUT;
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="textfield hidden-total-credits"> <!-- Thêm lớp CSS hidden-total-credits -->
        <label for="total-credits">Tổng số tín chỉ:</label>
        <input type="text" id="total-credits" value="<?php echo $totalCredits; ?>" readonly>
        <br>
        <label for="total-fee">Tổng số học phí cần đóng:</label>
        <input type="text" id="total-fee" value="<?php echo $totalCredits * 350000; ?>" readonly>
        <br>
    </div>

    <div class="payment-container">
        <h1>Trang thanh toán</h1>
        <p>Tên ngân hàng: Sacombank</p>
        <p>Số tài khoản: 040419042003</p>
        <p>Số tiền: <span id="payment-amount"><?php echo $totalCredits * 350000; ?></span></p>
        <p>Nội dung chuyển khoản: Đóng học phí đại học Sài Gòn</p>
        <div class="button-container d-flex flex-row-reverse gap-2">
            <button class="btn btn-primary" onclick="confirmPayment()">Xác nhận</button>
            <button class="btn btn-danger" onclick="returnProceedPayment()">Đóng</button>
        </div>
    </div>

    <div id="chatbox" class="chatbox-container">
        <p>Nếu bạn nhấn nút xác nhận, hệ thống sẽ lưu thông tin của bạn là đã thanh toán.</p>
        <p>Mời bạn kiểm tra kĩ trước khi xác nhận.</p>
        <div class="button-container d-flex flex-row-reverse gap-2">
            <button class="btn btn-primary" onclick="proceedPayment()">Xác nhận</button>
            <button class="btn btn-danger" onclick="closeChatbox()">Đóng</button>
        </div>
    </div>

    <script>
        function confirmPayment() {
            // Hiển thị chatbox thông báo
            document.getElementById("chatbox").style.display = "block";
        }

        function closeChatbox() {
            // Đóng chatbox
            document.getElementById("chatbox").style.display = "none";
        }


        function proceedPayment() {
            location.href = "/Home/XNTT"

        }

        function calcCredit() {

        }
    </script>
</body>

</html>