<?php
include('./database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $role = $_POST['role'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $birth = $_POST['birth'];
  $salary = $_POST['salary'];

  $query = "UPDATE nhanvien SET tennhanvien = ?, vaitro = ?, sodienthoai = ?, email = ?, gioitinh = ?, ngaysinh = ?, luong = ? WHERE id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ssssssdi", $name, $role, $phone, $email, $gender, $birth, $salary, $id);

  if ($stmt->execute()) {
    header("Location: ../staff.php"); // Redirect lại trang quản lý nhân viên sau khi sửa thành công
  } else {
    echo "Lỗi: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
