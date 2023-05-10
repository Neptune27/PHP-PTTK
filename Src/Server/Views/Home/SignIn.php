<link rel="stylesheet" href="/Src/Client/css/Login/Login.css">
<link rel="stylesheet" href="/Src/Client/css/User/UserOverview.css">
<link rel="stylesheet" href="/Src/Client/css/User/sign.css">

<main class="loginMain d-flex flex-column align-items-center">
    <div class="loginContent ">
        <section class="m-auto mt-5 mb-5 bg-white rounded-4 text-dark">
            <h1 class="text-center p-4 fw-bold">Đăng nhập</h1>
            <h3 class="p-4 text-center fw-bold errorMsg" id="error" style="display: none"></h3>
            <form action="" id="signInForm" class="p-4 needs-validation">
                <div class="mt-4 has-validation">
                    <label for="email" class="h5">MSSV</label>
                    <input type="text" name="mssv" class="form-control flex-fill mb-0"
                           placeholder="Mã số sinh viên" id="email">
                </div>
                <div class="mt-4">
                    <label for="password" class="h5">Mật khẩu</label>
                    <input type="password" name="pass" class="form-control flex-fill mb-0"
                           placeholder="Nhập mật khẩu" id="password" required>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary rounded-2 mt-4">Đăng nhập</button>
                </div>
            </form>
        </section>
    </div>
</main>
