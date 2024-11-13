<?php
// Kết nối cơ sở dữ liệu
include('./database.php');

// Kiểm tra xem form đã được gửi hay chưa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Lấy dữ liệu từ form
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
  $query = "SELECT id FROM nguoidung WHERE email = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $email); // Ràng buộc email
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    // Email đã tồn tại
    echo "<script>alert('Email đã tồn tại.'); window.location.href = '../signup.php';</script>";
  } else {
    // Mã hóa mật khẩu
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Thêm người dùng vào bảng
    $insertQuery = "INSERT INTO nguoidung (name, email, password) VALUES (?, ?, ?)";
    $stmtInsert = $conn->prepare($insertQuery);
    $stmtInsert->bind_param("sss", $name, $email, $hashedPassword); // Ràng buộc các giá trị
    $stmtInsert->execute();

    // Kiểm tra kết quả
    if ($stmtInsert->affected_rows > 0) {
      echo "<script> window.location.href = '../login.php'; alert('Đăng ký thành công.');</script>";
    } else {
      echo "<script>alert('Có lỗi xảy ra, vui lòng thử lại.'); window.location.href = '../signup.php';</script>";
    }
  }

  // Đóng kết nối
  $stmt->close();
  $stmtInsert->close();
  $conn->close();
}
