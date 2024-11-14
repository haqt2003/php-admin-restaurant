<?php
include('./database.php');

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT id, name, email, password FROM nguoidung WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra nếu có người dùng với email này
if ($result->num_rows > 0) {
  // Lấy dữ liệu người dùng
  $user = $result->fetch_assoc();

  // Kiểm tra mật khẩu (sử dụng password_verify nếu mật khẩu đã được hash)
  if (password_verify($password, $user['password'])) {
    // Lưu trữ thông tin người dùng vào session
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_email'] = $user['email'];

    // Chuyển hướng đến trang chủ hoặc trang quản lý
    header("Location: ../home.php");
    exit();
  } else {
    echo "<script>alert('Mật khẩu không chính xác!'); window.location.href = '../login.php';</script>";
  }
} else {
  echo "<script>alert('Không tìm thấy tài khoản với email này!'); window.location.href = '../login.php';</script>";
}

// Đóng kết nối
$conn->close();
