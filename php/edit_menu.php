<?php
include('./database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = intval($_POST['id']);
  $name = $_POST['name'];
  $price = $_POST['price'];
  $category = $_POST['category'];
  $description = $_POST['description'];

  $image_path = ""; // Biến để lưu đường dẫn ảnh mới

  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $image_name = basename($_FILES['image']['name']);
    $target_dir = "../assets/images/";
    $target_file = $target_dir . $image_name;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
      $image_path = "assets/images/" . $image_name;
    }
  }

  $query = "UPDATE monan SET tenmonan='$name', gia='$price', theloai='$category', mota='$description'";
  if ($image_path) {
    $query .= ", hinhanh='$image_path'";
  }
  $query .= " WHERE id='$id'";

  if ($conn->query($query) === TRUE) {
    echo "<script>window.location.href = '../menu.php';</script>";
  } else {
    echo "<script>alert('Sửa món ăn thất bại.'); window.location.href = '../menu.php';</script>";
  }
  $conn->close();
}
