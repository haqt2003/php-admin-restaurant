<?php
$servername = "localhost";
$username = "root";       // Thay bằng username của bạn
$password = "";           // Thay bằng password của bạn
$dbname = "admin";  // Thay bằng tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
