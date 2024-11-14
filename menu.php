<?php
include('./php/database.php');

session_start();

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['user_name'])) {
  $userName = $_SESSION['user_name'];
} else {
  echo "<script>window.location.href = './login.php';</script>";
}

// Số lượng món ăn hiển thị trên mỗi trang
$limit = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Kiểm tra nếu có yêu cầu lọc theo thể loại
$category = isset($_GET['category']) ? $_GET['category'] : '';

if ($category) {
  $query = "SELECT * FROM monan WHERE theloai = ? LIMIT ? OFFSET ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("sii", $category, $limit, $offset);
  $stmt->execute();
  $result = $stmt->get_result();
} else {
  $query = "SELECT * FROM monan LIMIT ? OFFSET ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ii", $limit, $offset);
  $stmt->execute();
  $result = $stmt->get_result();
}

// Đếm tổng số hàng trong cơ sở dữ liệu để tính toán tổng số trang
$countQuery = $category ? "SELECT COUNT(*) AS total FROM monan WHERE theloai = ?" : "SELECT COUNT(*) AS total FROM monan";
$stmt = $conn->prepare($countQuery);
if ($category) $stmt->bind_param("s", $category);
$stmt->execute();
$countResult = $stmt->get_result();
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@100..1000&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/menu.css" />
  <link rel="stylesheet" href="./css/themify-icons.css" />
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-2 tab py-3">
        <div class="d-flex px-4">
          <h4 class="mb-0">ADMIN</h4>
        </div>
        <hr />
        <a href="./home.php" class="mt-4 tab_item">
          <i class="ti-home"></i>
          <span>Trang chủ</span>
        </a>
        <a href="./menu.php" class="tab_item active">
          <i class="ti-menu-alt"></i>
          <span>Thực đơn</span>
        </a>
        <a href="./staff.php" class="tab_item">
          <i class="ti-user"></i>
          <span>Nhân viên</span>
        </a>
        <a href="./customer.php" class="tab_item">
          <i class="ti-face-smile"></i>
          <span>Khách hàng</span>
        </a>
        <a href="./order.php" class="tab_item">
          <i class="ti-clipboard"></i>
          <span>Đơn hàng</span>
        </a>
        <!-- <hr class="hr-tab" /> -->
        <button
          class="btn btn-danger bg-danger-btn logout-btn"
          data-bs-toggle="modal"
          data-bs-target="#signOut">
          Đăng xuất
        </button>
      </div>
      <div class="col"></div>
      <div class="col-10 main">
        <div class="header d-flex align-items-center justify-content-between">
          <div class="input-group search-bar">
            <!-- <input
              type="text"
              class="form-control"
              placeholder="Vui lòng nhập..."
              aria-label="Recipient's username"
              aria-describedby="button-addon2" />
            <button
              class="btn btn-outline-success"
              type="button"
              id="button-addon2">
              Tìm kiếm
            </button> -->
          </div>
          <div class="d-flex gap-2 align-items-center header_user">
            <span>Chào, <?php echo $userName; ?>! </span>
            <i class="ti-angle-down dropdown-user"></i>

            <ul class="list-group header_user-dropdown visually-hidden">
              <a href="./user.php" class="list-group-item">Tài khoản</a>
              <a
                href=""
                class="list-group-item"
                data-bs-toggle="modal"
                data-bs-target="#signOut">Đăng xuất</a>
            </ul>
          </div>
        </div>
        <div class="mt-4 wrapper-content">
          <div class="d-flex justify-content-between">
            <h3>Thực đơn</h3>
            <div class="d-flex gap-2 justify-content-end">
              <select
                id="categoryFilter"
                class="form-select select-menu"
                aria-label="Default select example">

                <!-- Sử dụng PHP để kiểm tra và đánh dấu selected vào tùy chọn đã chọn -->
                <option value="" <?php echo ($category == '') ? 'selected' : ''; ?>>Tất cả</option>
                <option value="hai-san" <?php echo ($category == 'hai-san') ? 'selected' : ''; ?>>Hải sản</option>
                <option value="thit-nuong" <?php echo ($category == 'thit-nuong') ? 'selected' : ''; ?>>Thịt nướng</option>
                <option value="dimsum" <?php echo ($category == 'dimsum') ? 'selected' : ''; ?>>Dimsum, Cơm, Mỳ</option>
                <option value="rau-cu" <?php echo ($category == 'rau-cu') ? 'selected' : ''; ?>>Rau củ quả nướng</option>
                <option value="lau" <?php echo ($category == 'lau') ? 'selected' : ''; ?>>Lẩu</option>
              </select>
              <button
                type="button"
                class="btn btn-primary bg-primary-btn export-menu-btn"
                onclick="window.location.href='./php/export_menu.php'">
                <i class="ti-export"></i>
                Xuất CSV
              </button>

              <button
                type="button"
                class="btn btn-success bg-success-btn add-menu-btn"
                data-bs-toggle="modal"
                data-bs-target="#modalAdd">
                <i class="ti-plus"></i>
                Thêm món ăn
              </button>
            </div>
          </div>
          <div class="row">
            <?php
            // Kiểm tra nếu có dữ liệu trong bảng `monan`
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                // Hiển thị thông tin từng món ăn
                $theloai = '';
                switch ($row['theloai']) {
                  case 'lau':
                    $theloai = 'Lẩu';
                    break;
                  case 'hai-san':
                    $theloai = 'Hải sản';
                    break;
                  case 'thit-nuong':
                    $theloai = 'Thịt nướng';
                    break;
                  case 'dimsum':
                    $theloai = 'Dimsum, Cơm, Mỳ';
                    break;
                  case 'rau-cu':
                    $theloai = 'Rau củ quả nướng';
                    break;
                  default:
                    $theloai = htmlspecialchars($row['theloai']);
                    break;
                }
            ?>
                <div class="col-12 col-sm-6 col-lg-3 mt-4" data-id="<?php echo $row['id']; ?>">
                  <div class="card">
                    <div class="ratio ratio-4x3">
                      <img
                        src="<?php echo $row['hinhanh']; ?>"
                        class="card-img-top"
                        alt="<?php echo htmlspecialchars($row['tenmonan']); ?>" />
                    </div>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo htmlspecialchars($row['tenmonan']); ?></h5>
                      <p class="card-text">
                        Giá: <?php echo number_format($row['gia'], 0, ',', '.'); ?>đ <br />
                        Thể loại: <?php echo $theloai; ?>
                      </p>
                      <div class="d-flex gap-2">
                        <button
                          class="btn btn-primary bg-primary-btn"
                          data-bs-toggle="modal"
                          data-bs-target="#modalEdit"
                          data-id="<?php echo $row['id']; ?>"
                          data-name="<?php echo htmlspecialchars($row['tenmonan']); ?>"
                          data-price="<?php echo $row['gia']; ?>"
                          data-category="<?php echo $row['theloai']; ?>"
                          data-description="<?php echo htmlspecialchars($row['mota']); ?>"
                          data-image="<?php echo $row['hinhanh']; ?>">
                          Sửa
                        </button>


                        <button
                          class="btn btn-danger bg-danger-btn"
                          data-bs-toggle="modal"
                          data-bs-target="#modalDelete"
                          data-id="<?php echo $row['id']; ?>">
                          Xóa
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
            <?php
              }
            } else {
              echo "<p class='text-center mt-5'>Không có món ăn nào trong cơ sở dữ liệu.</p>";
            }

            ?>
          </div>
          <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example" class="mt-4">
              <ul class="pagination">
                <?php if ($page > 1): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>&category=<?php echo $category; ?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                  <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>&category=<?php echo $category; ?>"><?php echo $i; ?></a>
                  </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>&category=<?php echo $category; ?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </nav>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div
    class="modal fade"
    id="signOut"
    tabindex="-1"
    aria-labelledby="signOutLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="signOutLabel">Đăng xuất</h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">Bạn chắc chắn muốn đăng xuất?</div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal">
            Đóng
          </button>
          <a
            href="./login.php"
            type="button"
            class="btn btn-danger bg-danger-btn">Đăng xuất</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Thêm -->
  <div
    class="modal fade"
    id="modalAdd"
    tabindex="-1"
    aria-labelledby="modalAddLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAddLabel">Thêm món ăn</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="./php/add_menu.php" method="post" enctype="multipart/form-data" id="addMenuForm">
            <div class="mb-4">
              <label for="nameAdd" class="form-label">Tên món ăn</label>
              <input type="text" class="form-control" id="nameAdd" name="name" />
            </div>
            <div class="row">
              <div class="col">
                <div class="mb-4">
                  <label for="priceAdd" class="form-label">Đơn giá</label>
                  <input type="text" class="form-control" id="priceAdd" name="price" />
                </div>
              </div>
              <div class="col">
                <div class="mb-4">
                  <label for="categoryAdd" class="form-label">Thể loại</label>
                  <select class="form-select" id="categoryAdd" name="category">
                    <option selected disabled>Chọn</option>
                    <option value="hai-san">Hải sản</option>
                    <option value="thit-nuong">Thịt nướng</option>
                    <option value="dimsum">Dimsum, Cơm, Mỳ</option>
                    <option value="rau-cu">Rau củ quả nướng</option>
                    <option value="lau">Lẩu</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="mb-4">
              <label for="fileAdd" class="form-label">Hình ảnh minh họa</label>
              <input class="form-control" type="file" id="fileAdd" name="image" />
            </div>
            <div class="mb-4">
              <label for="descAdd" class="form-label">Mô tả</label>
              <textarea class="form-control" id="descAdd" name="description" rows="4"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal">
            Đóng
          </button>
          <button id="addMenuBtn" class="btn btn-success bg-success-btn">
            Thêm
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Sửa -->
  <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditLabel">Sửa món ăn</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editMenuForm" action="./php/edit_menu.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="editId">
            <div class="mb-4">
              <label for="nameEdit" class="form-label">Tên món ăn</label>
              <input type="text" class="form-control" id="nameEdit" name="name">
            </div>
            <div class="row">
              <div class="col">
                <div class="mb-4">
                  <label for="priceEdit" class="form-label">Đơn giá</label>
                  <input type="text" class="form-control" id="priceEdit" name="price">
                </div>
              </div>
              <div class="col">
                <div class="mb-4">
                  <label for="categoryEdit" class="form-label">Thể loại</label>
                  <select class="form-select" id="categoryEdit" name="category">
                    <option value="hai-san">Hải sản</option>
                    <option value="thit-nuong">Thịt nướng</option>
                    <option value="dimsum">Dimsum, Cơm, Mỳ</option>
                    <option value="rau-cu">Rau củ quả nướng</option>
                    <option value="lau">Lẩu</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="mb-4">
              <label for="fileEdit" class="form-label">Tải ảnh mới</label>
              <input type="file" class="form-control" id="fileEdit" name="image">
            </div>
            <div class="mb-4">
              <label for="descEdit" class="form-label">Mô tả</label>
              <textarea class="form-control" id="descEdit" name="description" rows="4"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary" id="saveEdit">Lưu thay đổi</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Xóa -->
  <<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDeleteLabel">Xóa món ăn</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Bạn chắc chắn muốn xóa món ăn này?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="button" class="btn btn-danger bg-danger-btn" id="confirmDelete">Xóa</button>
        </div>
      </div>
    </div>
    </div>
    <script>
      // JavaScript để kích hoạt submit form khi nhấn vào nút "Thêm"
      document.getElementById("addMenuBtn").addEventListener("click", function() {
        document.getElementById("addMenuForm").submit();
      });

      document.querySelectorAll('button[data-bs-target="#modalEdit"]').forEach(button => {
        button.addEventListener('click', function() {
          const id = this.getAttribute('data-id');
          const name = this.getAttribute('data-name');
          const price = this.getAttribute('data-price');
          const category = this.getAttribute('data-category');
          const description = this.getAttribute('data-description');

          document.getElementById('editId').value = id;
          document.getElementById('nameEdit').value = name;
          document.getElementById('priceEdit').value = price;
          document.getElementById('categoryEdit').value = category;
          document.getElementById('descEdit').value = description;
        });
      });

      document.getElementById("saveEdit").addEventListener("click", function() {
        document.getElementById("editMenuForm").submit();
      });


      document.getElementById("saveEdit").addEventListener("click", function() {
        document.getElementById("editMenuForm").submit();
      });


      // JavaScript để lọc món ăn theo thể loại khi người dùng thay đổi lựa chọn
      document.getElementById("categoryFilter").addEventListener("change", function() {
        const selectedCategory = this.value;
        window.location.href = `menu.php?category=${selectedCategory}`;
      });

      let deleteId; // Biến lưu trữ ID món ăn cần xóa

      // Khi nút "Xóa" được nhấn, lấy ID của món ăn và gán vào deleteId
      document
        .querySelectorAll('button[data-bs-target="#modalDelete"]')
        .forEach((button) => {
          button.addEventListener("click", function() {
            deleteId = this.getAttribute("data-id");
          });
        });

      // Khi xác nhận xóa, gửi yêu cầu xóa
      document.getElementById("confirmDelete").addEventListener("click", function() {
        if (deleteId) {
          window.location.href = `./php/delete_menu.php?id=${deleteId}`;
        }
      });
    </script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
    <script src="./js/home.js"></script>
    <script src="./js/menu.js"></script>
</body>

</html>