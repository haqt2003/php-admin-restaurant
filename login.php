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
  <link
    href="https://fonts.googleapis.com/css2?family=LXGW+WenKai+TC&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/login.css" />
  <link rel="stylesheet" href="./css/themify-icons.css" />
</head>

<body>
  <div class="container-fluid login-page">
    <div class="row login-containter">
      <div class="col-12 col-lg-6 login-form text-center">
        <h2 class="login-text mb-4">Đăng nhập</h2>
        <form action="./php/login.php" method="POST" id="loginForm">
          <div class="form-floating mb-3">
            <input
              type="email"
              class="form-control"
              id="floatingInput"
              placeholder="name@example.com"
              name="email"
              required />
            <label for="floatingInput">Địa chỉ email</label>
          </div>
          <div class="form-floating mb-4">
            <input
              type="password"
              class="form-control"
              id="floatingPassword"
              placeholder="Password"
              name="password"
              required />
            <label for="floatingPassword">Mật khẩu</label>
          </div>
          <button
            type="submit"
            class="btn btn-success bg-success-btn login-btn mb-3">
            Đăng nhập
          </button>
        </form>
        <div class="">
          Bạn chưa có tài khoản? <a href="./signup.php">Đăng ký</a>
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
  <script src="./js/login.js"></script>
</body>

</html>