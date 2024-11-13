<?php
include('./database.php');

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=nhanvien.csv');

// Mở output stream để ghi dữ liệu CSV
$output = fopen('php://output', 'w');

// Ghi dòng tiêu đề cho file CSV
fputcsv($output, array('ID', 'Tên nhân viên', 'Vai trò', 'Số điện thoại', 'Email', 'Giới tính', 'Ngày sinh', 'Lương'));

// Truy vấn tất cả các bản ghi từ bảng nhanvien
$query = "SELECT * FROM nhanvien";
$result = $conn->query($query);

// Ghi từng dòng dữ liệu vào file CSV
while ($row = $result->fetch_assoc()) {
  fputcsv($output, $row);
}

// Đóng kết nối và output stream
fclose($output);
$conn->close();
