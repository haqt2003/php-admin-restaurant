<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng ký</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/login.css" />
</head>

<body>
  <div class="container-fluid login-page">
    <div class="row login-containter">
      <div class="col-12 col-lg-6 login-form text-center">
        <h2 class="login-text mb-4">Đăng ký</h2>
        <form action="./php/add_user.php" method="POST" id="signupForm">
          <div class="form-floating mb-3">
            <input
              type="text"
              class="form-control"
              id="floatingName"
              placeholder="Họ và tên"
              name="name"
              required />
            <label for="floatingName">Họ và tên</label>
          </div>
          <div class="form-floating mb-3">
            <input
              type="email"
              class="form-control"
              id="floatingEmail"
              placeholder="Email"
              name="email"
              required />
            <label for="floatingEmail">Địa chỉ email</label>
          </div>
          <div class="form-floating mb-4">
            <input
              type="password"
              class="form-control"
              id="floatingPassword"
              placeholder="Mật khẩu"
              name="password"
              required />
            <label for="floatingPassword">Mật khẩu</label>
          </div>
          <button
            type="submit"
            class="btn btn-success bg-success-btn login-btn mb-3">
            Đăng ký
          </button>
        </form>
        <div class="">
          Bạn đã có tài khoản? <a href="./login.php">Đăng nhập</a>
        </div>
      </div>
      <div class="col-0 col-lg-6 banner">
        <div class="sticky-text">上海弄堂</div>
      </div>
    </div>
  </div>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>