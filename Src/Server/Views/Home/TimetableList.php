<?php
    if (!isset($data)) {
        $data = [];
    }
?>

<script>
    const optionHandler = (event) => {
        location.href = `/Home/TimetableList/${event.target.value}`
    }
</script>

<div class="mt-4 mb-4 d-flex justify-content-between">
    <h5>
        <?php
//        print_r($_SESSION);
        echo "{$_SESSION["user"]["MSSV"]} - {$_SESSION['user']['HO_TEN']}";
        ?>
    </h5>
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="/Home/TimetableList" type="button" class="btn btn-secondary">Danh sách</a>
        <a href="/Home/Timetable" type="button" class="btn btn-outline-secondary">TKB</a>
    </div>
    <div>
        <select class="form-select " onchange="optionHandler(event)">
            <?php
            foreach ($data["HK"] as $index => $datum) {
                echo <<<HUH
                    <option value="{$datum['NAM']}/{$datum["HK"]}">HK {$datum["HK"]} - Năm {$datum["NAM"]}</option>
                HUH;

                }
            ?>
        </select>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover table-bordered ">
        <thead>
        <tr>
            <th scope="col">Mã MH</th>
            <th scope="col">Tên MH</th>
            <th scope="col">NMH</th>
            <th scope="col">Thứ</th>
            <th scope="col">Tiết BD</th>
            <th scope="col">Tiết KT</th>
            <th scope="col">Phòng</th>
            <th scope="col">Tuần</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data["DSMH"] as $index => $datum) {
            echo <<<WUT
        <tr>
            <td>{$datum["MMH"]}</td>
            <td>{$datum["TENMH"]}</td>
            <td>{$datum["NHOM"]}</td>
            <td>{$datum["THU"]}</td>
            <td>{$datum["TIET_BAT_DAU"]}</td>
            <td>{$datum["TIET_KET_THUC"]}</td>
            <td>{$datum["LOP"]}</td>
            <td>{$datum["TUANHOC"]}</td>
        </tr>
        WUT;

        }

        ?>
        </tbody>
    </table>
</div>
