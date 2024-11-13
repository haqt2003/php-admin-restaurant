<?php
include('database.php'); // Kết nối đến cơ sở dữ liệu

// Lấy dữ liệu từ form
$phone = $_POST['phone'];
$employeeName = $_POST['employee'];
$dishIds = $_POST['dish']; // Mảng món ăn
$quantities = $_POST['quantity']; // Mảng số lượng

// Kiểm tra dữ liệu món ăn và số lượng
if (empty($dishIds) || empty($quantities)) {
  die("Không có món ăn hoặc số lượng được chọn.");
}

// Lấy ID khách hàng từ số điện thoại
$query = "SELECT id FROM khachhang WHERE sodienthoai = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $phone);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();
$customerId = $customer['id'] ?? null; // Kiểm tra nếu không có khách hàng

// Lấy ID nhân viên từ tên nhân viên
$query = "SELECT id FROM nhanvien WHERE tennhanvien = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $employeeName);
$stmt->execute();
$result = $stmt->get_result();
$employee = $result->fetch_assoc();
$employeeId = $employee['id'] ?? null; // Kiểm tra nếu không có nhân viên


// Tính tổng tiền đơn hàng
$totalAmount = 0;
foreach ($dishIds as $index => $dishId) {
  // Kiểm tra giá trị món ăn
  $query = "SELECT gia FROM monan WHERE id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $dishId);
  $stmt->execute();
  $result = $stmt->get_result();
  $dish = $result->fetch_assoc();

  // Lấy giá món ăn và số lượng
  $price = floatval($dish['gia']); // Đảm bảo là số
  $quantity = intval($quantities[$index]); // Đảm bảo là số
  $totalAmount += $price * $quantity;
}

// Thêm đơn hàng vào bảng `donhang`
$query = "INSERT INTO donhang (idkhachhang, idnhanvien, tonggiatri, ngaytaodon) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($query);
$stmt->bind_param("iid", $customerId, $employeeId, $totalAmount);
$stmt->execute();
$orderId = $conn->insert_id; // Lấy ID của đơn hàng vừa tạo

// Thêm chi tiết món ăn vào bảng `chitietdonhang`
foreach ($dishIds as $index => $dishId) {
  $quantity = intval($quantities[$index]); // Đảm bảo số lượng là số
  $query = "INSERT INTO chitietdonhang (iddonhang, idmonan, soluong) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("iii", $orderId, $dishId, $quantity);
  $stmt->execute();
}

// Cập nhật số đơn hàng và tổng chi tiêu của khách hàng
$query = "UPDATE khachhang SET tongsodonhang = tongsodonhang + 1, tongchitieu = tongchitieu + ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("di", $totalAmount, $customerId);
$stmt->execute();

$conn->close();
echo "Đơn hàng đã được thêm thành công!";
