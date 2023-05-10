<link rel="stylesheet" href="/Src/Client/css/Login/Login.css">
<script src="/Src/Client/js/ArtistEdit.js" defer></script>

<div class="loginMain d-flex flex-column align-items-center">
    <div class="loginContent">
        <section class="m-auto bg-white rounded-4 text-dark">
            <h1 class="text-center p-4 fw-bold">Thêm ca sĩ</h1>
            <div id="signInForm" class="p-4 needs-validation">

                <div class="mt-4 has-validation">
                    <label for="artistName" class="h5">Tên ca sĩ</label>
                    <input type="text" name="artistName" class="form-control flex-fill mb-0"
                           placeholder="Tên ca sĩ" id="artistName">
                </div>
                <div class="mt-4">
                    <label for="artistAvatar" class="h5">Hình đại diện</label>
                    <input type="file" name="artistAvatar" class="form-control flex-fill mb-0" id="artistAvatar">
                </div>
                <div class="mt-4">
                    <label for="artistGender" class="h5">Giới tính</label>
                    <select name="artistGender" id="artistGender" class="form-control flex-fill mb-0">
                        <option value="0">Nam</option>
                        <option value="1">Nữ</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="artistDOB" class="h5">Ngày sinh</label>
                    <input type="date" name="artistDOB" class="form-control flex-fill mb-0" id="artistDOB">
                </div>
                <div class="mt-4">
                    <label for="artistVerify" class="h5">Verify</label>
                    <br>
                    <input type="radio" name="artistVerify" id="yesOption" value="1" checked>
                    <label for="yesOption">Yes</label>
                    <input type="radio" name="artistVerify" id="noOption" value="0">
                    <label for="noOption">No</label>
                </div>
                <div class="mt-4">
                    <label for="artistCountry" class="h5">Quốc tịch</label>
                    <input type="text" name="artistCountry" class="form-control flex-fill mb-0"
                           placeholder="Quốc tịch" id="artistCountry">
                </div>
                <div class="mt-4">
                    <label for="artistEmail" class="h5">Email</label>
                    <input type="email" name="artistEmail" class="form-control flex-fill mb-0"
                           placeholder="Email" id="artistEmail">
                </div>
                <div class="mt-4">
                    <label for="artistType" class="h5">Thể loại</label>
                    <select name="artistType" id="artistType" class="form-control flex-fill mb-0">
                        <option value="2">Ca sĩ</option>
                        <option value="3">Nhạc sĩ</option>
                        <option value="4">Ca sĩ và nhạc sĩ</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="artistListener" class="h5">Lượt nghe hằng tháng</label>
                    <input type="number" name="artistListener" class="form-control flex-fill mb-0"
                           placeholder="Lượt nghe" id="artistListener">
                </div>

                <div class="d-flex justify-content-center gap-1">
                    <button type="submit" class="btn btn-primary text-break mt-5" style="width: 100%" id="addArtist">Xác nhận</button>
                    <button class="btn btn-secondary text-break mt-5" style="width: 100%">Thoát</button>
                </div>
            </div>
        </section>
    </div>
</div>

