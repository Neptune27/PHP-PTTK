<header class="headerNav">
    <div class="header-content" style="z-index: 10;">

        <a href="#" class="logo">BHNT</a>

        <input type="checkbox" id="hamburger" aria-label="menu button">
        <label for="hamburger"><span></span></label>

        <nav aria-label="main navigation">
            <ul class="menus" style="z-index: 10">
                <li><a href="/">Trang chủ</a></li>
                <li>
                    <a href="/"
                       type="button"
                       aria-haspopup="true"
                       aria-expanded="true"
                       aria-controls="dropdown1"
                    >
                        Đăng ký môn học
                    </a>
                </li>

                <li>
                    <a href="/"
                       type="button"
                       aria-haspopup="true"
                       aria-expanded="true"
                       aria-controls="dropdown1"
                    >
                        Thời khóa biểu
                    </a>
                </li>

                <li>
                    <a href="/"
                       type="button"
                       aria-haspopup="true"
                       aria-expanded="true"
                       aria-controls="dropdown1"
                    >
                        Thanh toán
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