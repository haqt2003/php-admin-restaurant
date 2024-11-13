<?php
// Kết nối cơ sở dữ liệu
include('./php/database.php');

// Truy vấn lấy danh sách món ăn từ cơ sở dữ liệu
$query = "SELECT id, tenmonan FROM monan";
$result = $conn->query($query);

// Tạo các option cho dropdown
$dishOptions = '';
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $dishOptions .= '<option value="' . $row['id'] . '">' . $row['tenmonan'] . '</option>';
  }
}

// Đóng kết nối cơ sở dữ liệu
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
  <link rel="stylesheet" href="./css/order.css" />
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
        <a href="./order.php" class="tab_item active">
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
            <input
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
                data-bs-target="#signOut">Đăng xuất</a>
            </ul>
          </div>
        </div>
        <div class="mt-4 wrapper-content">
          <div class="d-flex justify-content-between">
            <h3>Đơn hàng</h3>
            <div class="d-flex gap-2 justify-content-end wrapper-order-btn">
              <select
                class="form-select select-menu"
                aria-label="Default select example">
                <option selected>Tất cả thời gian</option>
                <option value="this-week">Trong tuần này</option>
                <option value="this-month">Trong tháng này</option>
                <option value="this-year">Trong năm nay</option>
              </select>
              <button
                type="button"
                class="btn btn-primary bg-primary-btn export-order-btn">
                <i class="ti-export"></i>
                Xuất CSV
              </button>
              <button
                type="button"
                class="btn btn-success bg-success-btn add-order-btn"
                data-bs-toggle="modal"
                data-bs-target="#modalAdd">
                <i class="ti-plus"></i>
                Thêm hóa đơn
              </button>
            </div>
          </div>
          <table class="table table-bordered mt-3">
            <thead>
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Mã đơn hàng</th>
                <th scope="col">Ngày tạo đơn</th>
                <th scope="col" style="width: 200px">Món ăn</th>
                <th scope="col">Giá trị</th>
                <th scope="col">Khách hàng</th>
                <th scope="col">Nhân viên thu ngân</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>123456</td>
                <td>20/01/2024 – 14:30</td>
                <td>
                  <table class="table table-bordered">
                    <tr>
                      <td style="width: 70%">Lẩu ếch</td>
                      <td>1</td>
                    </tr>
                    <tr>
                      <td style="width: 70%">Cá cay</td>
                      <td>2</td>
                    </tr>
                  </table>
                </td>
                <td>5.000.000đ</td>
                <td>Trần Quang Hà</td>
                <td>Nguyễn Văn A</td>
              </tr>

            </tbody>
          </table>

          <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example" class="mt-3">
              <ul class="pagination">
                <li class="page-item disabled">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <li class="page-item active" aria-current="page">
                  <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
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
          <h5 class="modal-title" id="modalAddLabel">Thêm đơn hàng</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="./php/add_order.php" method="POST" id="addOrderForm">
            <div class="wrapper-order-dish">
              <div class="row mb-4 align-items-center">
                <div class="col-7">
                  <div class="">
                    <select class="form-control" id="customerAddDish" name="dish[]">
                      <?php echo $dishOptions; // In các option vào dropdown 
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-5 resizeBox">
                  <div class="">
                    <input
                      name="quantity[]"
                      type="number"
                      class="form-control"
                      id="customerAddQuantity"
                      placeholder="Nhập số lượng" />
                  </div>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-end mb-5">
              <button
                style="width: 150px"
                type="button"
                class="btn btn-success bg-success-btn d-flex align-items-center gap-2 btnAddDish">
                <i class="ti-plus"></i>
                Thêm món mới
              </button>
            </div>
            <div class="row">
              <div class="col">
                <div class="mb-4">
                  <label for="customerAdd" class="form-label">Số điện thoại khách hàng
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    id="customerAdd"
                    aria-describedby="customerAdd"
                    name="phone" />
                </div>
              </div>
              <div class="col">
                <div class="mb-4">
                  <label for="staffAdd" class="form-label">Nhân viên thu ngân</label>
                  <input type="text" class="form-control" id="staffAdd" name="employee" />
                </div>
              </div>
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
          <button type="button" class="btn btn-success bg-success-btn" onclick="document.getElementById('addOrderForm').submit();">
            Thêm
          </button>
        </div>
      </div>
    </div>
  </div>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script>
    var dishOptions = "<?php echo addslashes($dishOptions); ?>";
  </script>
  <script src="./js/home.js"></script>
  <script src="./js/order.js">

  </script>
</body>

</html>