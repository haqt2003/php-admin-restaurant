<?php
include('./database.php');

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=monan.csv');

// Mở output stream
$output = fopen('php://output', 'w');

// Ghi dòng tiêu đề cho file CSV
fputcsv($output, array('ID', 'Tên món ăn', 'Giá', 'Thể loại', 'Hình ảnh', 'Mô tả'));

// Lấy dữ liệu từ cơ sở dữ liệu
$query = "SELECT * FROM monan";
$result = $conn->query($query);

// Ghi từng dòng dữ liệu vào file CSV
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
  }
}

// Đóng kết nối và output stream
fclose($output);
$conn->close();
exit();
