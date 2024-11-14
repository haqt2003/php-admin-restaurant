<?php
include('./database.php');

// Kiểm tra nếu có form gửi lên
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $userEmail = $_POST['email']; // Lấy email từ form ẩn
  $newName = $_POST['name'];
  $newPassword = $_POST['password']; // Mật khẩu mới (nếu có)

  // Nếu có thay đổi mật khẩu, mã hóa mật khẩu mới
  if (!empty($newPassword)) {
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $updateQuery = "UPDATE nguoidung SET name = ?, password = ? WHERE email = ?"; // Sử dụng email thay vì ID
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sss", $newName, $hashedPassword, $userEmail); // Sử dụng email thay vì ID
  } else {
    // Nếu không thay đổi mật khẩu, chỉ cập nhật tên
    $updateQuery = "UPDATE nguoidung SET name = ? WHERE email = ?"; // Sử dụng email thay vì ID
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ss", $newName, $userEmail); // Sử dụng email thay vì ID
  }

  // Thực thi câu lệnh SQL
  if ($stmt->execute()) {
    session_start();
    $_SESSION['user_name'] = $newName;
    echo "<script>alert('Cập nhật thông tin thành công!'); window.location.href = '../user.php';</script>";
  } else {
    echo "<script>alert('Có lỗi xảy ra, vui lòng thử lại!'); window.location.href = '../user.php';</script>";
  }

  // Đóng kết nối
  $stmt->close();
  $conn->close();
}
