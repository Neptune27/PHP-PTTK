<!DOCTYPE html>
<html>

<head>
    <title>Giao diện Học Phí</title>
    <style>
        /* CSS cho ô vuông thông tin sinh viên */
        .student-info {
            width: 400px;
            height: 200px;
            border: 1px solid #ccc;
            border-radius: 8px;
            text-align: left;
            margin: 0 auto;
            margin-top: 20px;
            padding: 20px;
        }

        /* CSS cho bảng môn học */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        /* CSS cho nút thanh toán */
        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button-container button {
            margin-right: 10px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            background-color: #036ffc;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="student-info">
        <p>Họ tên sinh viên: <?php
            echo $_SESSION["user"]["HO_TEN"]
            ?></p>
        <p>MSSV: <?php
            echo $_SESSION["user"]["MSSV"]
            ?></p>
        <p>Lớp: <?php
            echo $_SESSION["user"]["ID_LOP"]
            ?></p>
        <p>Hệ đào tạo: Đại học chính quy</p>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
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
            <td id = "credit">{$datum["TINCHI"]}</td>
        </tr>
        WUT;
                }

                ?>
            </tbody>
        </table>
    </div>



    <div id="totalCredit" style="display: flex; align-items: center; justify-content: space-around; gap: 1rem">
        <div>
            <label for="total-credits">Tổng số tín chỉ:</label>
            <input type="text" id="total-credits" value="<?php echo $totalCredits; ?>" readonly>
        </div>
        <div>
            <label for="total-fee">Tổng số học phí cần đóng:</label>
            <input type="text" id="total-fee" value="<?php echo $totalCredits * 350000; ?>" readonly>
        </div>
        <div>
            <label for="total-fee">Trạng thái:</label>
            <input type="text" id="total-fee" value="<?php echo $data["TT_MESSAGE"] ?>" readonly>
        </div>

    </div>
    <div class="button-container">
        <a class="btn btn-primary" href="/Home/ThanhToan">Thanh toán</a>
    </div>

</body>

</html>