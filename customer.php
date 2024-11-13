<?php
include('./php/database.php'); // Kết nối đến cơ sở dữ liệu

// Xác định số dòng trên mỗi trang
$limit = 10; // 10 khách hàng mỗi trang

// Tính toán trang hiện tại
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Truy vấn lấy dữ liệu từ bảng khachhang với phân trang
$query = "SELECT * FROM khachhang LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

// Truy vấn để lấy tổng số khách hàng
$totalQuery = "SELECT COUNT(*) AS total FROM khachhang";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalCustomers = $totalRow['total'];

// Tính toán số trang
$totalPages = ceil($totalCustomers / $limit);

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
  <link rel="stylesheet" href="./css/customer.css" />
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
        <a href="./customer.php" class="tab_item active">
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
            <h3>Khách hàng</h3>
            <div
              class="d-flex gap-2 justify-content-end wrapper-customer-btn">
              <button
                type="button"
                class="btn btn-primary bg-primary-btn export-customer-btn"
                onclick="window.location.href='./php/export_customer.php'">
                <i class="ti-export"></i>
                Xuất CSV
              </button>
              <button
                type="button"
                class="btn btn-success bg-success-btn add-customer-btn"
                data-bs-toggle="modal"
                data-bs-target="#modalAdd">
                <i class="ti-plus"></i>
                Thêm khách hàng
              </button>
            </div>
          </div>
          <table class="table table-bordered mt-4">
            <thead>
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Họ và tên</th>
                <th scope="col">Giới tính</th>
                <th scope="col">Ngày sinh</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col" style="width: 140px">Tổng số đơn hàng</th>
                <th scope="col">Tổng chi tiêu</th>
                <th class="text-end"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($result->num_rows > 0) {
                $stt = 1; // Số thứ tự
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                              <th scope='row'>" . $stt++ . "</th>
                              <td>" . $row['tenkhachhang'] . "</td>
                              <td>" . $row['gioitinh'] . "</td>
                              <td>" . date("d/m/Y", strtotime($row['ngaysinh'])) . "</td>
                              <td>" . $row['sodienthoai'] . "</td>
                              <td>" . $row['tongsodonhang'] . "</td>
                              <td>" . number_format($row['tongchitieu'], 0, ',', '.') . "đ</td>
                              <td class='text-end'>
                                <button 
  type='button' 
  class='btn btn-primary bg-primary-btn' 
  data-bs-toggle='modal' 
  data-bs-target='#modalEdit'
  data-id='" . $row['id'] . "'
  data-name='" . $row['tenkhachhang'] . "'
  data-gender='" . $row['gioitinh'] . "'
  data-phone='" . $row['sodienthoai'] . "'
  data-birth='" . $row['ngaysinh'] . "'>
  Sửa
</button>

                                <button type='button' class='btn btn-danger bg-danger-btn' data-bs-toggle='modal' data-bs-target='#modalDelete' data-id='" . $row['id'] . "'>
    Xóa
</button>
                              </td>
                            </tr>";
                }
              } else {
                echo "<tr><td colspan='8' class='text-center'>Không có dữ liệu</td></tr>";
              }
              ?>
            </tbody>
          </table>

          <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example" class="mt-3">
              <ul class="pagination">
                <!-- Nút "Previous" -->
                <?php if ($page > 1): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                <?php endif; ?>

                <!-- Các số trang -->
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                  <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                  </li>
                <?php endfor; ?>

                <!-- Nút "Next" -->
                <?php if ($page < $totalPages): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
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
          <h5 class="modal-title" id="modalAddLabel">Thêm khách hàng</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Thay đổi form để gửi dữ liệu tới add_customer.php -->
          <form action="./php/add_customer.php" method="POST" id="addCustomerForm">
            <div class="row">
              <div class="col">
                <div class="mb-4">
                  <label for="nameAdd" class="form-label">Tên khách hàng</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nameAdd"
                    name="name"
                    required />
                </div>
              </div>
              <div class="col">
                <div class="mb-4">
                  <label for="genderAdd" class="form-label">Giới tính</label>
                  <select class="form-select" name="gender" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="mb-4">
                  <label for="phoneAdd" class="form-label">Số điện thoại</label>
                  <input
                    type="text"
                    class="form-control"
                    id="phoneAdd"
                    name="phone"
                    required />
                </div>
              </div>
              <div class="col">
                <div class="mb-4">
                  <label for="birthAdd" class="form-label">Ngày sinh</label>
                  <input
                    type="date"
                    class="form-control"
                    id="birthAdd"
                    name="birth"
                    required />
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
          <!-- Button để submit form -->
          <button
            type="button"
            class="btn btn-success bg-success-btn"
            onclick="document.getElementById('addCustomerForm').submit();">
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
          <h5 class="modal-title" id="modalEditLabel">Sửa khách hàng</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="./php/edit_customer.php" method="POST" id="editCustomerForm">
            <input type="hidden" name="id" id="editId">
            <div class="row">
              <div class="col">
                <div class="mb-4">
                  <label for="nameEdit" class="form-label">Tên khách hàng</label>
                  <input type="text" class="form-control" id="nameEdit" name="name" required />
                </div>
              </div>
              <div class="col">
                <div class="mb-4">
                  <label for="genderEdit" class="form-label">Giới tính</label>
                  <select class="form-select" id="genderEdit" name="gender" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="mb-4">
                  <label for="phoneEdit" class="form-label">Số điện thoại</label>
                  <input type="text" class="form-control" id="phoneEdit" name="phone" required />
                </div>
              </div>
              <div class="col">
                <div class="mb-4">
                  <label for="birthEdit" class="form-label">Ngày sinh</label>
                  <input type="date" class="form-control" id="birthEdit" name="birth" required />
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary bg-primary-btn" onclick="document.getElementById('editCustomerForm').submit();">Lưu thay đổi</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Xóa -->
  <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDeleteLabel">Xóa khách hàng</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">Bạn chắc chắn muốn xóa khách hàng này?</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="button" class="btn btn-danger bg-danger-btn" id="confirmDelete">Xóa</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    let deleteId;

    // Khi nhấn vào nút "Xóa" trong bảng, lưu ID khách hàng
    document.querySelectorAll('button[data-bs-target="#modalDelete"]').forEach(button => {
      button.addEventListener('click', function() {
        deleteId = this.getAttribute('data-id'); // Lấy ID của khách hàng từ thuộc tính data-id
      });
    });

    // Khi nhấn vào nút "Xóa" trong modal, thực hiện xóa khách hàng
    document.getElementById('confirmDelete').addEventListener('click', function() {
      if (deleteId) {
        window.location.href = `./php/delete_customer.php?id=${deleteId}`;
      }
    });


    document.querySelectorAll('button[data-bs-target="#modalEdit"]').forEach(button => {
      button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const name = this.getAttribute('data-name');
        const gender = this.getAttribute('data-gender');
        const phone = this.getAttribute('data-phone');
        const birth = this.getAttribute('data-birth');

        document.getElementById('editId').value = id;
        document.getElementById('nameEdit').value = name;
        document.getElementById('genderEdit').value = gender;
        document.getElementById('phoneEdit').value = phone;
        document.getElementById('birthEdit').value = birth;
      });
    });
  </script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="./js/home.js"></script>
  <script src="./js/customer.js"></script>
</body>

</html>