<?php
include('./database.php');

// Lấy dữ liệu khách hàng từ cơ sở dữ liệu
$query = "SELECT * FROM khachhang";
$result = $conn->query($query);

// Thiết lập tiêu đề cho file CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="customers.csv"');

// Mở file CSV để xuất
$output = fopen('php://output', 'w');

// Ghi tiêu đề cột
fputcsv($output, ['ID', 'Tên khách hàng', 'Giới tính', 'Ngày sinh', 'Số điện thoại', 'Tổng số đơn hàng', 'Tổng chi tiêu']);

// Ghi dữ liệu khách hàng vào CSV
while ($row = $result->fetch_assoc()) {
  fputcsv($output, $row);
}

// Đóng file sau khi xuất
fclose($output);
exit();
