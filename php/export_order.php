<?php
// Kết nối cơ sở dữ liệu
include('./database.php');

// Kiểm tra kết nối cơ sở dữ liệu
if ($conn->connect_error) {
  die("Kết nối CSDL thất bại: " . $conn->connect_error);
}

// Lọc theo thời gian
$timeFilter = isset($_GET['time_filter']) ? $_GET['time_filter'] : 'all-time';

// Truy vấn lấy danh sách đơn hàng với điều kiện lọc và phân trang
$query1 = "
  SELECT donhang.id AS order_id, donhang.ngaytaodon, khachhang.tenkhachhang, nhanvien.tennhanvien, 
         monan.tenmonan, chitietdonhang.soluong, monan.gia, 
         (chitietdonhang.soluong * monan.gia) AS total_price
  FROM donhang
  JOIN chitietdonhang ON donhang.id = chitietdonhang.iddonhang
  JOIN monan ON chitietdonhang.idmonan = monan.id
  JOIN khachhang ON donhang.idkhachhang = khachhang.id
  JOIN nhanvien ON donhang.idnhanvien = nhanvien.id
  WHERE 1=1
  ORDER BY donhang.id DESC";

$result1 = $conn->query($query1);

// Kiểm tra kết quả của truy vấn
if ($result1 === false) {
  die("Có lỗi trong truy vấn CSDL: " . $conn->error);
}

// Tạo file CSV
$filename = "don_hang_export_" . date('Ymd') . ".csv";
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=\"$filename\"");
$output = fopen("php://output", "w");

// Thêm header cho CSV
fputcsv($output, ["STT", "Mã đơn hàng", "Ngày tạo đơn", "Món ăn", "Giá trị", "Khách hàng", "Nhân viên thu ngân"]);

$count = 1;
while ($row = $result1->fetch_assoc()) {
  // Tạo danh sách các món ăn trong đơn hàng
  $items = "";
  $query2 = "SELECT monan.tenmonan, chitietdonhang.soluong FROM chitietdonhang 
                   JOIN monan ON chitietdonhang.idmonan = monan.id 
                   WHERE chitietdonhang.iddonhang = " . $row['order_id'];
  $result2 = $conn->query($query2);

  // Kiểm tra kết quả của truy vấn món ăn
  if ($result2 === false) {
    die("Có lỗi trong truy vấn món ăn: " . $conn->error);
  }

  while ($item = $result2->fetch_assoc()) {
    $items .= $item['tenmonan'] . " (x" . $item['soluong'] . "), ";
  }
  $items = rtrim($items, ", ");

  // Ghi vào file CSV
  fputcsv($output, [
    $count++,
    $row['order_id'],
    date('d/m/Y - H:i:s', strtotime($row['ngaytaodon'])),
    $items,
    number_format($row['total_price'], 0, ',', '.') . "đ",
    $row['tenkhachhang'],
    $row['tennhanvien']
  ]);
}
fclose($output);
exit();


// Đóng kết nối cơ sở dữ liệu
$conn->close();
