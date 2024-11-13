<?php
include('./database.php');

// Kiểm tra nếu có ID khách hàng cần xóa
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Xóa khách hàng dựa trên ID
  $query = "DELETE FROM khachhang WHERE id = ?";
  $stmt = $conn->prepare($query);

  if ($stmt) {
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
      echo "<script>
        window.location.href = '../customer.php'; 
        </script>";
      exit;
    } else {
      echo "<script>alert('Xóa khách hàng thất bại.'); window.location.href = '../customer.php';</script>";
    }
    $stmt->close();
  } else {
    echo "<script>alert('Lỗi trong khi chuẩn bị truy vấn.'); window.location.href = '../customer.php';</script>";
  }
}

$conn->close();
