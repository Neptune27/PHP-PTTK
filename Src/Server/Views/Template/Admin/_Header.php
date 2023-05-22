<header>
    <div class="header-content" style="z-index: 10;">

        <a href="#" class="logo">BHNT</a>

        <input type="checkbox" id="hamburger" aria-label="menu button">
        <label for="hamburger"><span></span></label>

        <nav aria-label="main navigation">
            <ul class="menus" style="z-index: 10">
                <li><a href="/Admin">Trang chủ</a></li>
                <li>
                    <button
                        type="button"
                        aria-haspopup="true"
                        aria-expanded="true"
                        aria-controls="dropdown2"
                    >
                        Quản lý cơ sở<span class="arrow"></span>
                    </button>
                    <ul class="dropdown" id="dropdown2">
                        <li><a href="/Admin/Nganh">Ngành</a></li>
                        <li><a href="/Admin/Khoa">Khoa</a></li>
                        <li><a href="/Admin/Lop">Lớp</a></li>
                        <li><a href="/Admin/Mon">Môn học</a></li>
                        <li><a href="/Admin/MonTienQuyet">Môn tiên quyết</a></li>
                        <li><a href="/Admin/GiaoVien">Giáo viên</a></li>
                        <li><a href="/Admin/SinhVien">Sinh Viên</a></li>
                    </ul>
                </li>
                <li>
                    <button
                        type="button"
                        aria-haspopup="true"
                        aria-expanded="true"
                        aria-controls="dropdown2"
                    >
                        Quản lý học phần<span class="arrow"></span>
                    </button>
                    <ul class="dropdown" id="dropdown2">
                        <li><a href="/Admin/LopHocPhan">Lớp học phần</a></li>
                        <li><a href="/Admin/TKB">Thời khóa biểu</a></li>
                        <li><a href="/Admin/YCMM">Yêu cầu mở lớp</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/Admin/Payment"
                       type="button"
                       aria-haspopup="true"
                       aria-expanded="true"
                       aria-controls="dropdown1"
                    >
                        Quản lý thanh toán
                    </a>
                </li>

                <?php
                if (isset($_SESSION["user"])) {
                    echo <<<WUT
                <li>
                    <button
                            type="button"
                            aria-haspopup="true"
                            aria-expanded="true"
                            aria-controls="dropdown2"
                    > 
                    {$_SESSION["user"]["HO_TEN"]}
                    <span class="arrow"></span>
                    </button>
                    <ul class="dropdown" id="dropdown2">
                        <li><a href="/Home/Signout">Thông tin tài khoản</a></li>
                        <li><a href="/Home/Signout">Đăng xuất</a></li>
                    </ul>
                </li>
                WUT;
                }
                else {
                    echo <<<HUH
                    <li>
                        <a href="/Home/SignIn"
                           type="button"
                           aria-haspopup="true"
                           aria-expanded="true"
                           aria-controls="dropdown1"
                        >
                            Đăng nhập
                        </a>
                    </li>
                    HUH;

                }
                ?>

            </ul>
        </nav>
    </div>
</header>