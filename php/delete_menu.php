<?php
include('./database.php');

// Kiểm tra nếu `id` tồn tại trong URL
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Truy vấn xóa món ăn dựa vào ID
  $query = "DELETE FROM monan WHERE id = $id";

  if ($conn->query($query) === TRUE) {
    echo "<script>
      window.location.href = '../menu.php'; 
      </script>";
    exit;
  } else {
    echo "<script>alert('Xóa món ăn thất bại.'); window.location.href = '../menu.php';</script>";
  }
}
$conn->close();
