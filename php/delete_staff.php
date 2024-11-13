<?php
include('./database.php');

// Kiểm tra nếu ID nhân viên được gửi qua URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Câu truy vấn xóa nhân viên theo ID
  $query = "DELETE FROM nhanvien WHERE id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    echo "<script>
                window.location.href = '../staff.php'; 
              </script>";
    exit;
  } else {
    echo "Lỗi: Không thể xóa nhân viên.";
  }

  $stmt->close();
} else {
  echo "Lỗi: ID nhân viên không hợp lệ.";
}

$conn->close();
