<?php

class HomeController extends Controller
{
    public string $homeTemplate = "Home/_default";
    public string $signTemplate = "signDefault";



    function index() : void
    {
        header("Location: /Home/Home");
    }

    function Home() {
        $this->view($this->homeTemplate, []);
    }

    function SignIn()
    {
        if (isset($_GET["mssv"]) && isset($_GET["pass"])) {
            $model = $this->model("UserModel");
            $res = $model->getUser($_GET["mssv"], $_GET["pass"]);
            if (isset($res[0])) {
                $_SESSION["user"] = $res[0];
            }
        }

        if (isset($_SESSION["user"])) {
            header("Location: /");
            return;
        }

        $this->view($this->signTemplate, []);
    }

    function Timetable($params) {
        $model = $this->model("UserModel");

        $queryHK = <<<HUH
        SELECT DISTINCT HK, NAM FROM SinhVien_LHP WHERE MSSV='3121560004' ORDER BY NAM, HK DESC
        HUH;
        $hk = $model->getData($queryHK);

        if (!isset($params[0]) || !isset($params[1])) {
            $params[0] = $hk[0]["NAM"];
            $params[1] = $hk[0]["HK"];
        }

        array_unshift($hk,[
            "HK" => $params[1],
            "NAM" => $params[0]
        ]);

        $hk = array_unique($hk, SORT_REGULAR);


        $query = <<<WUT
        SELECT SV.ID_DSMH, SL_SV, NGAY_BAT_DAU, TIET_BAT_DAU, TIET_KET_THUC, LOP, TUANHOC, TEN as TENMH, THU FROM SinhVien_LHP SV
            JOIN Lop_Hoc_Phan LHP on LHP.ID_DSMH = SV.ID_DSMH and LHP.NAM_HOC = SV.NAM and LHP.HOC_KY = SV.HK
            JOIN ThoiGianMonHoc TGMH on LHP.ID_DSMH = TGMH.ID_DSMH and LHP.NAM_HOC = TGMH.NAM and LHP.HOC_KY = TGMH.HK
            LEFT JOIN MonHoc MH on MH.ID = LHP.ID_MONHOC
        WHERE MSSV='3121560004' AND SV.NAM={$params[0]} AND SV.HK={$params[1]}
        WUT;

        $data = $model->getData($query);
        foreach ($data as $index => $item) {
            $DSMH = $item["ID_DSMH"];
            $ID_NHOM = explode("_", $DSMH);
            $data[$index]["MMH"]= $ID_NHOM[0];
            $data[$index]["NHOM"]= $ID_NHOM[1];
        }
//        print_r($data);
        $this->view($this->homeTemplate, [
            "DSMH" => $data,
            "HK" => $hk
        ]);
    }

    function TimetableList($params) {
        $model = $this->model("UserModel");

        $queryHK = <<<HUH
        SELECT DISTINCT HK, NAM FROM SinhVien_LHP WHERE MSSV='3121560004' ORDER BY NAM, HK DESC
        HUH;
        $hk = $model->getData($queryHK);

        if (!isset($params[0]) || !isset($params[1])) {
            $params[0] = $hk[0]["NAM"];
            $params[1] = $hk[0]["HK"];
        }

        array_unshift($hk,[
            "HK" => $params[1],
            "NAM" => $params[0]
        ]);

        $hk = array_unique($hk, SORT_REGULAR);


        $query = <<<WUT
        SELECT SV.ID_DSMH, SL_SV, NGAY_BAT_DAU, TIET_BAT_DAU, TIET_KET_THUC, LOP, TUANHOC, TEN as TENMH, THU FROM SinhVien_LHP SV
            JOIN Lop_Hoc_Phan LHP on LHP.ID_DSMH = SV.ID_DSMH and LHP.NAM_HOC = SV.NAM and LHP.HOC_KY = SV.HK
            JOIN ThoiGianMonHoc TGMH on LHP.ID_DSMH = TGMH.ID_DSMH and LHP.NAM_HOC = TGMH.NAM and LHP.HOC_KY = TGMH.HK
            LEFT JOIN MonHoc MH on MH.ID = LHP.ID_MONHOC
        WHERE MSSV='3121560004' AND SV.NAM={$params[0]} AND SV.HK={$params[1]}
        WUT;

        $data = $model->getData($query);
        foreach ($data as $index => $item) {
            $DSMH = $item["ID_DSMH"];
            $ID_NHOM = explode("_", $DSMH);
            $data[$index]["MMH"]= $ID_NHOM[0];
            $data[$index]["NHOM"]= $ID_NHOM[1];
        }
//        print_r($data);
        $this->view($this->homeTemplate, [
            "DSMH" => $data,
            "HK" => $hk
        ]);
    }

    public function SignOut() {
        unset($_SESSION["user"]);
        header("Location: /");
    }


}