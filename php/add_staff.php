<?php
include('./database.php');

// Kiểm tra nếu có dữ liệu từ form gửi lên
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $tennhanvien = $_POST['name'];
  $vaitro = $_POST['role'];
  $sodienthoai = $_POST['phone'];
  $email = $_POST['email'];
  $gioitinh = $_POST['gender'];
  $ngaysinh = $_POST['birth'];
  $luong = $_POST['salary'];

  // Câu lệnh SQL thêm nhân viên
  $query = "INSERT INTO nhanvien (tennhanvien, vaitro, sodienthoai, email, gioitinh, ngaysinh, luong) VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ssssssd", $tennhanvien, $vaitro, $sodienthoai, $email, $gioitinh, $ngaysinh, $luong);

  if ($stmt->execute()) {
    // Chuyển hướng về trang nhân viên sau khi thêm thành công
    header("Location: ../staff.php");
    exit();
  } else {
    echo "Có lỗi xảy ra: " . $stmt->error;
  }
  $stmt->close();
  $conn->close();
}
