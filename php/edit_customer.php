<?php
include('./database.php');

// Kiểm tra xem dữ liệu POST đã được gửi hay chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $phone = $_POST['phone'];
  $birth = $_POST['birth'];

  // Cập nhật thông tin khách hàng
  $query = "UPDATE khachhang SET tenkhachhang = ?, gioitinh = ?, sodienthoai = ?, ngaysinh = ? WHERE id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ssssi", $name, $gender, $phone, $birth, $id);

  if ($stmt->execute()) {
    echo "<script>window.location.href = '../customer.php';</script>";
  } else {
    echo "<script>alert('Cập nhật khách hàng thất bại.'); window.location.href = '../customer.php';</script>";
  }

  $stmt->close();
  $conn->close();
} else {
  echo "<script>alert('Dữ liệu không hợp lệ.'); window.location.href = '../customer.php';</script>";
}
