<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('./database.php');

    // Nhận dữ liệu từ biểu mẫu
    $tenmonan = $_POST['name'];
    $gia = $_POST['price'];
    $theloai = $_POST['category'];
    $mota = $_POST['description'];

    // Xử lý tải lên tệp ảnh
    $hinhanh = NULL;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = basename($_FILES['image']['name']);

        // Đường dẫn tương đối đến thư mục "images" (từ tệp hiện tại)
        $target_dir = "../assets/images/";
        $target_file = $target_dir . $image_name;

        // Di chuyển tệp ảnh vào thư mục "images"
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Lưu đường dẫn tương đối của ảnh để lưu trong cơ sở dữ liệu
            $hinhanh = "assets/images/" . $image_name;
        } else {
            echo "Có lỗi xảy ra khi tải lên tệp ảnh.";
        }
    }

    // Chèn dữ liệu vào bảng `monan`
    $sql = "INSERT INTO monan (tenmonan, gia, theloai, hinhanh, mota) 
            VALUES ('$tenmonan', '$gia', '$theloai', '$hinhanh', '$mota')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                window.location.href = '../menu.php'; 
              </script>";
        exit;
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
}
