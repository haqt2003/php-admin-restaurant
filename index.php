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
  <link rel="stylesheet" href="./css/themify-icons.css" />
  <link rel="stylesheet" href="./css/index.css" />
  <style>
    .order-btn {
      font-size: 18px;
    }

    .img-main {
      width: 100%;
    }

    .banner {
      margin-top: 40px !important;
    }

    .contact-us {
      margin-top: 80px;
    }

    .popular-food {
      margin-top: 100px !important;
    }

    .item-list-img1 {
      width: 80px;
      height: 80px;
    }
  </style>
</head>

<body>
  <div class="container-xl py-4">
    <div class="d-flex justify-content-between align-items-center gap-3">
      <img src="./assets/images/logo-to.png" alt="" class="logo-to" />
      <div class="d-flex gap-5 align-items-center">
        <a href="" class="nav-item active-text">Trang chủ</a>
        <a href="" class="nav-item">Về chúng tôi</a>
        <a href="" class="nav-item">Thực đơn</a>
        <a href="" class="nav-item">Liên hệ</a>
        <div class="btn-group">
          <button
            type="button"
            class="btn btn-success bg-success-btn btn-account dropdown-toggle d-flex align-items-center gap-1"
            data-bs-toggle="dropdown"
            aria-expanded="false">
            Tài khoản
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="">Khách hàng</a>
            </li>
            <li>
              <a class="dropdown-item" href="./login.php">Quản lý</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row banner align-items-center justify-content-between">
      <div class="col-sm-6 col-12">
        <div class="sub-btn-text rounded-pill">Hẻm Thượng Hải</div>
        <h1 class="text-banner">
          Phong Vị <span class="active-text">Trung Hoa</span> Ngay Giữa Lòng
          Hà Nội
        </h1>
        <p class="mt-4">
          Hương vị Trung Hoa giữa lòng Hà Nội! Thưởng thức các món ăn đặc sắc từ Thượng Hải, từ dim sum hấp dẫn, mì xào thơm ngon đến hải sản tươi sống, tất cả đều mang đậm hương vị đặc trưng của vùng đất này. Không gian ấm cúng, món ăn ngon, là nơi lý tưởng để bạn thưởng thức cùng gia đình và bạn bè. Hãy đến và trải nghiệm những hương vị tuyệt vời tại nhà hàng của chúng tôi!
        </p>
        <div class="d-flex align-items-center gap-3 mt-4">
          <button
            type="button"
            class="btn btn-success bg-success-btn order-btn px-3 py-2">
            Đặt hàng ngay
          </button>
          <button
            type="button"
            class="btn btn-outline-success order-btn px-3 py-2">
            Liên hệ
          </button>
        </div>
      </div>
      <div class="col-sm-5 col-12 main-image rounded-4">
        <img
          src="./assets/images/ca-nuong-thuong-hai.jpg"
          alt=""
          class="img-main rounded-4" />
      </div>
    </div>
    <div class="row item-list1">
      <div class="col-4 d-flex gap-4 align-items-center">
        <img src="./assets/images/food.png" alt="" class="item-list-img1" />
        <div class="">
          <h4 class="mb-1">Món ăn bản địa</h4>
          <p class="text-justify mb-0">
            Thưởng thức các món ăn truyền thống với hương vị độc đáo và cách
            chế biến tinh tế
          </p>
        </div>
      </div>
      <div class="col-4 d-flex gap-4 align-items-center">
        <img src="./assets/images/veget.png" alt="" class="item-list-img1" />
        <div class="">
          <h4 class="mb-1">Rau củ quả tươi</h4>
          <p class="text-justify mb-0">
            Các món rau củ tươi ngon và bổ dưỡng sẽ làm hài lòng cả những thực
            khách khó tính nhất
          </p>
        </div>
      </div>
      <div class="col-4 d-flex gap-4 align-items-center">
        <img
          src="./assets/images/beverage.png"
          alt=""
          class="item-list-img1" />
        <div class="">
          <h4 class="mb-1">Thức uống thanh mát</h4>
          <p class="text-justify mb-0">
            Thưởng thức nước trà Trung Hoa, từ trà xanh thanh nhẹ đến trà hoa
            quả thơm ngon
          </p>
        </div>
      </div>
    </div>
    <div class="popular-food">
      <div class="d-flex justify-content-between align-items-center">
        <h1>Món ăn bán chạy 🔥</h1>
        <div class="d-flex gap-3">
          <div
            class="pre-btn rounded d-flex justify-content-center align-items-center">
            <i class="ti-angle-left active-text"></i>
          </div>
          <div
            class="next-btn rounded d-flex justify-content-center align-items-center">
            <i class="ti-angle-right"></i>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-sm-6 col-lg-3 mt-4">
          <div class="card">
            <div class="ratio ratio-4x3">
              <img
                src="./assets/images/lau-ech.jpg"
                class="card-img-top"
                alt="..." />
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Lẩu ếch</h4>
                <h6 class="d-flex align-items-center gap-1">
                  <img src="./assets/images/star.svg" alt="" />
                  4.8 sao (262)
                </h6>
              </div>
              <p class="card-text opa-85">
                Lẩu ếch Trung Quốc là một món ăn hấp dẫn, mang đến sự kết hợp
                hoàn hảo giữa hương vị tươi ngon và các gia vị đậm đà.
              </p>

              <div class="d-flex justify-content-between align-items-center">
                <h3 class="opa-85">300.000đ</h3>
                <button type="button" class="btn btn-outline-success">
                  Tìm hiểu thêm
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 mt-4">
          <div class="card">
            <div class="ratio ratio-4x3">
              <img
                src="./assets/images/ca-cay.jpg"
                class="card-img-top"
                alt="..." />
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Cá cay</h4>
                <h6 class="d-flex align-items-center gap-1">
                  <img src="./assets/images/star.svg" alt="" /> 4.8 sao (262)
                </h6>
              </div>
              <p class="card-text opa-85">
                Lẩu ếch Trung Quốc là một món ăn hấp dẫn, mang đến sự kết hợp
                hoàn hảo giữa hương vị tươi ngon và các gia vị đậm đà.
              </p>

              <div class="d-flex justify-content-between align-items-center">
                <h3 class="opa-85">320.000đ</h3>
                <button type="button" class="btn btn-outline-success">
                  Tìm hiểu thêm
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 mt-4">
          <div class="card">
            <div class="ratio ratio-4x3">
              <img
                src="./assets/images/ha-cao-tom.jpg"
                class="card-img-top"
                alt="..." />
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Há cảo tôm</h4>
                <h6 class="d-flex align-items-center gap-1">
                  <img src="./assets/images/star.svg" alt="" /> 4.8 sao (262)
                </h6>
              </div>
              <p class="card-text opa-85">
                Lẩu ếch Trung Quốc là một món ăn hấp dẫn, mang đến sự kết hợp
                hoàn hảo giữa hương vị tươi ngon và các gia vị đậm đà.
              </p>

              <div class="d-flex justify-content-between align-items-center">
                <h3 class="opa-85">16.000đ</h3>
                <button type="button" class="btn btn-outline-success">
                  Tìm hiểu thêm
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 mt-4">
          <div class="card">
            <div class="ratio ratio-4x3">
              <img
                src="./assets/images/ha-cao-so-toi.jpg"
                class="card-img-top"
                alt="..." />
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Há cảo sò tỏi</h4>
                <h6 class="d-flex align-items-center gap-1">
                  <img src="./assets/images/star.svg" alt="" />
                  4.8 sao (262)
                </h6>
              </div>
              <p class="card-text opa-85">
                Lẩu ếch Trung Quốc là một món ăn hấp dẫn, mang đến sự kết hợp
                hoàn hảo giữa hương vị tươi ngon và các gia vị đậm đà.
              </p>

              <div class="d-flex justify-content-between align-items-center">
                <h3 class="opa-85">50.000đ</h3>
                <button type="button" class="btn btn-outline-success">
                  Tìm hiểu thêm
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="contact-us rounded d-flex justify-content-between align-items-center">
      <div class="info p-4">
        <h1 class="">Đăng Ký Để Nhận Ưu Đãi</h1>
        <p class="mt-3">
          Để không bỏ lỡ những ưu đãi hấp dẫn từ chúng tôi, hãy điền địa chỉ
          email của bạn vào form dưới đây.<br />
          Bạn sẽ nhận được thông tin mới nhất về các chương trình khuyến mãi
          và sự kiện đặc biệt!
        </p>
        <div class="d-flex input-div align-items-center mt-4 gap-3">
          <div class="d-flex align-items-center gap-2">
            <i class="ti-email email-sub"></i>
            <input type="text" placeholder="Nhập email của bạn" />
          </div>
          <button type="button" class="btn btn-success bg-success-btn">
            Đăng ký
          </button>
        </div>
      </div>
      <div
        class="map-container d-flex justify-content-center align-items-center">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.2924013039087!2d105.7848415750301!3d20.980912980656466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135accdd8a1ad71%3A0xa2f9b16036648187!2zSOG7jWMgdmnhu4duIEPDtG5nIG5naOG7hyBCxrB1IGNow61uaCB2aeG7hW4gdGjDtG5n!5e0!3m2!1svi!2s!4v1729600255232!5m2!1svi!2s"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="map">
        </iframe>
      </div>
    </div>
    <div class="footer row align-items-start mt-5">
      <div class="col-3">
        <h5>Hẻm Thượng Hải</h5>
        <p class="mt-3">
          Hương vị Trung Hoa giữa lòng Hà Nội! Thưởng thức những món ăn đặc
          sắc từ Thượng Hải!
        </p>
        <div class="d-flex gap-3 align-items-center">
          <i class="cp ti-facebook"></i>
          <i class="cp ti-youtube"></i>
          <i class="cp ti-twitter-alt"></i>
          <i class="cp ti-linkedin"></i>
        </div>
        <img src="./assets/images/bct.png" alt="" class="bct" />
      </div>
      <div class="col-2">
        <h5>Về chúng tôi</h5>
        <p class="cp mt-3">Giới thiệu</p>
        <p class="cp">Bảo mật</p>
        <p class="cp">Hợp tác</p>
      </div>
      <div class="col-3">
        <h5>Mặt hàng</h5>
        <div class="d-flex gap-3">
          <div class="">
            <p class="cp mt-3">Rau củ quả nướng</p>
            <p class="cp">Salad</p>
            <p class="cp">Lẩu</p>
          </div>
          <div class="text-end">
            <p class="cp mt-3">Hải sản</p>
            <p class="cp">Thịt nướng</p>
            <p class="cp">Dimsum, Cơm, Mỳ</p>
          </div>
        </div>
      </div>
      <div class="col-2">
        <h5>Trợ giúp</h5>
        <p class="cp mt-3">Tài khoản</p>
        <p class="cp">Chính sách pháp lý</p>
        <p class="cp">Điều khoản và điều kiện</p>
      </div>
      <div class="col-2">
        <h5>Liên hệ</h5>
        <p class="d-flex align-items-center gap-2 mt-3">
          <i class="ti-mobile"></i>0969.048.062
        </p>
        <p class="d-flex align-items-center gap-2">
          <i class="ti-email"></i>haqt2003@gmail.com
        </p>
        <p class="d-flex align-items-center gap-2">
          <i class="ti-location-pin"></i>197 Trần Phú, Hà Đông
        </p>
      </div>
    </div>
    <hr class="mt-4" />
    <p class="mt-4">
      © 2024 Hẻm Thượng Hải. Thỏa thuận sử dụng & Chính sách bảo mật.
    </p>
  </div>
  <div class="gradient-circle1"></div>
  <div class="gradient-circle2"></div>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="./js/index.js"></script>
</body>

</html>