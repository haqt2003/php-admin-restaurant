<?php
include('./database.php'); // Kết nối tới cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $birth = $_POST['birth'];
  $phone = $_POST['phone'];

  // Chuẩn bị câu truy vấn SQL để thêm khách hàng mới
  $stmt = $conn->prepare("INSERT INTO khachhang (tenkhachhang, gioitinh, ngaysinh, sodienthoai) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $gender, $birth, $phone);

  if ($stmt->execute()) {
    echo "<script>
    window.location.href = '../customer.php'; 
  </script>";
    exit;
  } else {
    echo "Lỗi: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
