<?php
include('./php/database.php');

$query = "SELECT * FROM nhanvien";  // Chỉnh sửa "employees" nếu tên bảng của bạn khác
$result = $conn->query($query); // Thực thi truy vấn 
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
      crossorigin="anonymous"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@100..1000&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/home.css" />
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
          <a href="./home.php" class="mt-4 tab_item active">
            <i class="ti-home"></i>
            <span>Trang chủ</span>
          </a>
          <a href="./menu.php" class="tab_item">
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
            data-bs-target="#signOut"
          >
            Đăng xuất
          </button>
        </div>
        <div class="col"></div>
        <div class="col-10 main">
          <div class="header d-flex align-items-center justify-content-between">
            <div class="input-group search-bar">
              <input
                type="text"
                class="form-control"
                placeholder="Vui lòng nhập..."
                aria-label="Recipient's username"
                aria-describedby="button-addon2"
              />
              <button
                class="btn btn-outline-success"
                type="button"
                id="button-addon2"
              >
                Tìm kiếm
              </button>
            </div>
            <div class="d-flex gap-2 align-items-center header_user">
              <span>Chào, Trần Hà! </span>
              <i class="ti-angle-down dropdown-user"></i>

              <ul class="list-group header_user-dropdown visually-hidden">
                <a href="./user.php" class="list-group-item">Tài khoản</a>
                <a
                  href=""
                  class="list-group-item"
                  data-bs-toggle="modal"
                  data-bs-target="#signOut"
                  >Đăng xuất</a
                >
              </ul>
            </div>
          </div>
          <div class="mt-4 wrapper-content">
            <h3>Trang chủ</h3>
            <div class="mt-4 greeting px-5 py-4 shadow-sm">
              <h2>Xin chào!</h2>
              <div
                class="d-flex flex-wrap wrapper_greeting-text align-items-center"
              >
                <p class="mt-2 greeting-text">
                  Đây là không gian dành riêng cho người quản lý, với mục đích
                  theo dõi và điều hành hoạt động của Hẻm Thượng Hải một cách
                  hiệu quả.
                </p>
                <a
                  href="#start"
                  type="button"
                  class="btn btn-success greeting-btn px-3 d-flex gap-2 align-items-center bg-success-btn"
                >
                  <i class="ti-arrow-down"></i>
                  Bắt đầu
                </a>
              </div>
            </div>
            <div class="row mt-4 gap-3 items_containter-index" id="start">
              <div class="col text-center shadow-sm item-index">
                <div class="text-item-index1">TỔNG DOANH THU</div>
                <div class="text-item-index2">144.000.000</div>
                <div class="text-item-index3">VNĐ</div>
              </div>
              <div class="col text-center shadow-sm item-index">
                <div class="text-item-index1">SỐ MÓN ĂN</div>
                <div class="text-item-index2">50</div>
                <div class="text-item-index3">Món</div>
              </div>
              <div class="col text-center shadow-sm item-index">
                <div class="text-item-index1">NHÂN VIÊN</div>
                <div class="text-item-index2">70</div>
                <div class="text-item-index3">Người</div>
              </div>
              <div class="col text-center shadow-sm item-index">
                <div class="text-item-index1">TỔNG HÓA ĐƠN</div>
                <div class="text-item-index2">1000</div>
                <div class="text-item-index3">Đơn</div>
              </div>
            </div>
            <div class="row mt-4 gap-3 chart-container">
              <div class="col chart rounded shadow-sm">
                <canvas id="linechart"></canvas>
              </div>
              <div class="col chart rounded shadow-sm">
                <canvas id="barchart"></canvas>
              </div>
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
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="signOutLabel">Đăng xuất</h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">Bạn chắc chắn muốn đăng xuất?</div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Đóng
            </button>
            <a
              href="./login.php"
              type="button"
              class="btn btn-danger bg-danger-btn"
              >Đăng xuất</a
            >
          </div>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./js/chart.js"></script>
    <script src="./js/home.js"></script>
  </body>
</html>
