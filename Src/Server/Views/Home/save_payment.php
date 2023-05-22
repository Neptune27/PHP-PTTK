<?php
// Lấy thông tin từ body của yêu cầu
$totalCredits = $_POST['total_credits'];
$totalFee = $_POST['total_fee'];
$mssv = $_POST['mssv'];
$status = $_POST['status'];

// Kết nối đến database
$conn = new mysqli("localhost", "root", "gg", "QLMH");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Thực hiện truy vấn để lưu thông tin thanh toán vào database
// $sql = "INSERT INTO payments (total_credits, total_fee, mssv, status) VALUES ('$totalCredits', '$totalFee', '$mssv', '$status')";

$sql = "INSERT INTO `HocPhi`(`TIEN_HOC_PHI`, `TONG_TIN_CHI`, `ID_TRANG_THAI`, `MSSV`) VALUES ('{$totalFee}','{$totalCredits}','{$status}','{$mssv}')";

if ($conn->query($sql) === TRUE) {
    echo "Payment saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Đóng kết nối đến database
$conn->close();
