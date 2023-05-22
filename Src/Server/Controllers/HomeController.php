<?php

class HomeController extends Controller
{
    public string $homeTemplate = "Home/_default";
    public string $editTemplate = "Home/_edit";
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
        SELECT DISTINCT HK, NAM FROM SinhVien_LHP WHERE MSSV='{$_SESSION["user"]["MSSV"]}' ORDER BY NAM, HK DESC
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
        WHERE MSSV='{$_SESSION["user"]["MSSV"]}' AND SV.NAM={$params[0]} AND SV.HK={$params[1]}
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
        SELECT DISTINCT HK, NAM FROM SinhVien_LHP WHERE MSSV='{$_SESSION["user"]["MSSV"]}' ORDER BY NAM, HK DESC
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
        WHERE MSSV='{$_SESSION["user"]["MSSV"]}' AND SV.NAM={$params[0]} AND SV.HK={$params[1]}
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


    public function DKMH(){

        $model = $this->model("UserModel");
        if(!empty($_GET["ma"])){
            $ma = $_GET["ma"];
        }


        $sql = "SELECT DISTINCT NAM_HOC, HOC_KY
        FROM Lop_Hoc_Phan
        ORDER BY NAM_HOC DESC, HOC_KY DESC
        LIMIT 1;
        ";
        $hk_nam = $model->getData($sql);
        $nam =  $hk_nam[0]["NAM_HOC"];
        $hk =  $hk_nam[0]["HOC_KY"];


        $sql = "SELECT ID_MONHOC,MH.TEN,LHP.ID_DSMH,MH.TIN_CHI,LHP.SL_SV,TGMH.THU,TGMH.TIET_BAT_DAU,
        TGMH.TIET_KET_THUC,TGMH.LOP,GiaoVien.TEN as tenGV,TGMH.TUANHOC,COALESCE((LHP.SL_SV - slgDK), LHP.SL_SV) AS conLai  
        FROM Lop_Hoc_Phan LHP
        JOIN ThoiGianMonHoc TGMH on LHP.ID_DSMH = TGMH.ID_DSMH and LHP.NAM_HOC = TGMH.NAM and LHP.HOC_KY = TGMH.HK
        JOIN GiaoVien on TGMH.ID_GVGD = GiaoVien.ID
        LEFT JOIN MonHoc MH on MH.ID = LHP.ID_MONHOC
        LEFT JOIN (
            SELECT ID_DSMH,COUNT(ID_DSMH) as slgDK
            FROM SinhVien_LHP
            WHERE SinhVien_LHP.NAM = $nam and SinhVien_LHP.HK = $hk GROUP BY ID_DSMH
        ) AS svlhp on svlhp.ID_DSMH = LHP.ID_DSMH
        WHERE TGMH.HK = $hk and TGMH.NAM = $nam ";
        if(!empty($ma)){
            $sql = $sql." and ID_MONHOC ='$ma'";
        }
        $data = $model->getData($sql);

        $mssv = $_SESSION["user"]["MSSV"];

        $sql = "SELECT MonHoc.ID,MonHoc.TEN,SinhVien_MonHocTamThoi.IDHP,MonHoc.TIN_CHI,(MonHoc.TIN_CHI*Khoa.TIEN_1_TIN) as hocPhi
        FROM `SinhVien_MonHocTamThoi`
        INNER JOIN Lop_Hoc_Phan on Lop_Hoc_Phan.ID_DSMH = IDHP
        INNER JOIN MonHoc on MonHoc.ID = Lop_Hoc_Phan.ID_MONHOC
        INNER JOIN SinhVien on SinhVien.MSSV = SinhVien_MonHocTamThoi.MSSV
        INNER JOIN LopHoc on SinhVien.ID_LOP = LopHoc.ID
        INNER JOIN Nganh on LopHoc.ID_NGANH = Nganh.ID
        INNER JOIN Khoa on Khoa.ID = Nganh.ID_KHOA
        WHERE SinhVien_MonHocTamThoi.MSSV = '$mssv'";

        $dsMHDK = $model->getData($sql);

        $sql = "SELECT MonHoc.ID,MonHoc.TEN,SinhVien_LHP.ID_DSMH,MonHoc.TIN_CHI,(MonHoc.TIN_CHI*Khoa.TIEN_1_TIN) as hocPhi
        FROM `SinhVien_LHP` 
        INNER JOIN Lop_Hoc_Phan on Lop_Hoc_Phan.ID_DSMH = SinhVien_LHP.ID_DSMH
        INNER JOIN MonHoc on MonHoc.ID = Lop_Hoc_Phan.ID_MONHOC
        INNER JOIN SinhVien on SinhVien.MSSV = SinhVien_LHP.MSSV
        INNER JOIN LopHoc on SinhVien.ID_LOP = LopHoc.ID
        INNER JOIN Nganh on LopHoc.ID_NGANH = Nganh.ID
        INNER JOIN Khoa on Khoa.ID = Nganh.ID_KHOA
        WHERE SinhVien_LHP.MSSV = '$mssv'  AND SinhVien_LHP.NAM = $nam AND SinhVien_LHP.HK = $hk ";
        $dsMHDL = $model->getData($sql);

        $this->view($this->homeTemplate, [
            "a" => 2,
            "data" => $data,
            "dsmhdk"=>$dsMHDK,
            "dsmhdl"=>$dsMHDL,
        ]);
    }



    public function themMH(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $model = $this->model("UserModel");
            $data = json_decode(file_get_contents('php://input'), true);
            $id_dsmh = trim($data["id_dsmh"]) ;
            $mssv = $_SESSION["user"]["MSSV"];

            $send = array();
            $sql = "SELECT DISTINCT NAM_HOC, HOC_KY
            FROM Lop_Hoc_Phan
            ORDER BY NAM_HOC DESC, HOC_KY DESC
            LIMIT 1;
            ";
            $hk_nam = $model->getData($sql);
            $nam =  $hk_nam[0]["NAM_HOC"];
            $hk =  $hk_nam[0]["HOC_KY"];


            //LẤY THÔNG TIN VỀ MÔN HỌC
            $sql = "SELECT * FROM `Lop_Hoc_Phan` 
            INNER JOIN ThoiGianMonHoc on ThoiGianMonHoc.ID_DSMH = Lop_Hoc_Phan.ID_DSMH 
            INNER JOIN MonHoc on Lop_Hoc_Phan.ID_MONHOC = MonHoc.id 
            WHERE Lop_Hoc_Phan.ID_DSMH = '$id_dsmh'";
            $mh = $model->getData($sql);

            $idmh = $mh[0]["ID"];
            $tc = $mh[0]["TIN_CHI"];
            $slsv = $mh[0]["SL_SV"];
            $tietBD = array();
            $tietKT = array();
            $thu = array();
            $lop = array();
            for($i=0;$i<count($mh);$i++){
                $tietBD[]=$mh[$i]["TIET_BAT_DAU"];
                $tietKT[] = $mh[$i]["TIET_KET_THUC"];
                $thu[] = $mh[$i]["THU"];
                $lop[] = $mh[$i]["LOP"];
            }

            $kti = 1;

            $sql  = "SELECT * FROM `MonTienQuyet` WHERE ID_MON_HOC = '$idmh'";
            $temp = $model->getData($sql);

            if(!empty($temp)){
                $id_mht = $temp[0]["ID_MON_HOC_TRUOC"];
                $sql = "SELECT * FROM `SinhVien_LHP` 
                INNER JOIN Lop_Hoc_Phan on SinhVien_LHP.ID_DSMH = Lop_Hoc_Phan.ID_DSMH
                WHERE  MSSV = '$mssv' AND Lop_Hoc_Phan.ID_MONHOC = '$idmh' AND (NAM = !2023 or HK != 2) ";
                $t = $model->getData($sql);
                if(empty($t)){
                    $send["error"] = "Can hoc mon tien quyet ";
                    $kti = 0;
                }
            }

            // KIỂM TRA TRÙNG TKB
            for($i=0;$i<count($tietBD);$i++){

                $sql = "SELECT *
                FROM SinhVien_MonHocTamThoi
                INNER JOIN ThoiGianMonHoc ON ThoiGianMonHoc.ID_DSMH = SinhVien_MonHocTamThoi.IDHP
                WHERE ThoiGianMonHoc.THU = ".$thu[$i]." AND ThoiGianMonHoc.HK = $hk AND ThoiGianMonHoc.NAM = $nam  AND SinhVien_MonHocTamThoi.MSSV =  '$mssv' AND 
                (ThoiGianMonHoc.TIET_BAT_DAU <= ".$tietKT[$i]." AND ThoiGianMonHoc.TIET_KET_THUC >= ".$tietBD[$i].")";
                $temp = $model->getData($sql);
                if(!empty($temp)){
                    $send["error"] = "Trung TKB";
                    $kti = 0;
                }

                $sql = "SELECT *
                FROM SinhVien_LHP 
                INNER JOIN ThoiGianMonHoc ON ThoiGianMonHoc.ID_DSMH = SinhVien_LHP.ID_DSMH
                WHERE ThoiGianMonHoc.THU = ".$thu[$i]." AND ThoiGianMonHoc.HK = $hk AND ThoiGianMonHoc.NAM = $nam
                AND SinhVien_LHP.MSSV = '$mssv'  AND
                (ThoiGianMonHoc.TIET_BAT_DAU <= ".$tietKT[$i]." AND ThoiGianMonHoc.TIET_KET_THUC >= ".$tietBD[$i].")";

                $temp = $model->getData($sql);
                if(!empty($temp)){

                    $send["error"] = "Trung TKB";
                    $kti = 0;
                }
            }

            //KIỂM TRA TÍN CHỈ TỐI ĐA
            $sql = "SELECT IFNULL(sum(MonHoc.TIN_CHI), 0) as soTC FROM `SinhVien_LHP` 
            INNER JOIN Lop_Hoc_Phan on Lop_Hoc_Phan.ID_DSMH = SinhVien_LHP.ID_DSMH
            INNER JOIN MonHoc on MonHoc.ID = Lop_Hoc_Phan.ID_MONHOC
            WHERE SinhVien_LHP.MSSV = '$mssv'";
            $temp = $model->getData($sql);
            $soTC = $temp[0]["soTC"];
            if (!empty($soTC) && $soTC+$tc >26) {
                $send["error"] = "So Tin CHi da vuot qua toi da";
                $kti = 0;
            }

            $sql = "SELECT IFNULL(sum(MonHoc.TIN_CHI), 0) as soTC FROM SinhVien_MonHocTamThoi 
            INNER JOIN Lop_Hoc_Phan on Lop_Hoc_Phan.ID_DSMH = SinhVien_MonHocTamThoi.IDHP
            INNER JOIN MonHoc on MonHoc.ID = Lop_Hoc_Phan.ID_MONHOC
            WHERE SinhVien_MonHocTamThoi.MSSV = '$mssv'";
            $temp = $model->getData($sql);
            $soTC = $temp[0]["soTC"];
            if (!empty($soTC) && $soTC+$tc >26) {
                $send["error"] = "So Tin CHi da vuot qua toi da";
                $kti = 0;
            }


            //kIỂM TRA TRÙNG MÃ HP THÌ TỰ ĐỘNG THAY THẾ

            $sql = "SELECT * FROM `SinhVien_LHP`
            INNER JOIN Lop_Hoc_Phan on Lop_Hoc_Phan.ID_DSMH = SinhVien_LHP.ID_DSMH
            INNER JOIN MonHoc on  MonHoc.ID = Lop_Hoc_Phan.ID_MONHOC
            WHERE MonHoc.ID = '$idmh' AND SinhVien_LHP.MSSV = '$mssv'";
            $temp = $model->getData($sql);
            if(!empty($temp) && empty($send)){
                $sql = "DELETE FROM `SinhVien_LHP` WHERE ID_DSMH = '$id_dsmh' and MSSV = '$mssv' and HK = $hk and NAM = $nam";
                $model->update($sql);
            }

            $sql ="SELECT * FROM `SinhVien_MonHocTamThoi`
            INNER JOIN Lop_Hoc_Phan on Lop_Hoc_Phan.ID_DSMH = SinhVien_MonHocTamThoi.IDHP
            INNER JOIN MonHoc on  MonHoc.ID = Lop_Hoc_Phan.ID_MONHOC
            WHERE MonHoc.ID = '$idmh'  AND SinhVien_MonHocTamThoi.MSSV =  '$mssv' ";
            $temp = $model->getData($sql);
            if(!empty($temp) && empty($send)){
                $sql = "DELETE FROM `SinhVien_MonHocTamThoi` WHERE IDHP = '".$temp[0]["IDHP"]."' and MSSV = '$mssv'";
                $model->update($sql);
            }



            if(empty($send) && $kti == 1){
                $sql = "INSERT INTO `SinhVien_MonHocTamThoi`(`MSSV`, `IDHP`) VALUES ('$mssv','$id_dsmh')";

                $model->update($sql);
            }

            $sql = "SELECT MonHoc.ID,MonHoc.TEN,SinhVien_MonHocTamThoi.IDHP,MonHoc.TIN_CHI,(MonHoc.TIN_CHI*Khoa.TIEN_1_TIN) as hocPhi
            FROM `SinhVien_MonHocTamThoi`
            INNER JOIN Lop_Hoc_Phan on Lop_Hoc_Phan.ID_DSMH = SinhVien_MonHocTamThoi.IDHP
            INNER JOIN MonHoc on MonHoc.ID = Lop_Hoc_Phan.ID_MONHOC
            INNER JOIN SinhVien on SinhVien.MSSV = SinhVien_MonHocTamThoi.MSSV
            INNER JOIN LopHoc on SinhVien.ID_LOP = LopHoc.ID
            INNER JOIN Nganh on LopHoc.ID_NGANH = Nganh.ID
            INNER JOIN Khoa on Khoa.ID = Nganh.ID_KHOA
            WHERE SinhVien_MonHocTamThoi.MSSV = '$mssv'";

            $dsMHDK = $model->getData($sql);


            $sql = "SELECT MonHoc.ID,MonHoc.TEN,SinhVien_LHP.ID_DSMH,MonHoc.TIN_CHI,(MonHoc.TIN_CHI*Khoa.TIEN_1_TIN) as hocPhi
            FROM `SinhVien_LHP` 
            INNER JOIN Lop_Hoc_Phan on Lop_Hoc_Phan.ID_DSMH = SinhVien_LHP.ID_DSMH
            INNER JOIN MonHoc on MonHoc.ID = Lop_Hoc_Phan.ID_MONHOC
            INNER JOIN SinhVien on SinhVien.MSSV = SinhVien_LHP.MSSV
            INNER JOIN LopHoc on SinhVien.ID_LOP = LopHoc.ID
            INNER JOIN Nganh on LopHoc.ID_NGANH = Nganh.ID
            INNER JOIN Khoa on Khoa.ID = Nganh.ID_KHOA
            WHERE SinhVien_LHP.MSSV = '$mssv' AND SinhVien_LHP.NAM = $nam AND SinhVien_LHP.HK = $hk ";
            $dsMHDL = $model->getData($sql);

            $send["dsmhdk"] = $dsMHDK;
            $send["dsmhdl"] = $dsMHDL;

            $send = json_encode($send);
            echo $send;
        }
        else{
            header("Location: http://localhost/Home/DKMH");
            exit;
        }
    }

    public function xoaMH(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $model = $this->model("UserModel");
            $data = json_decode(file_get_contents('php://input'), true);
            $id_dsmh = trim($data["id_dsmh"]) ;
            $mssv = $_SESSION["user"]["MSSV"];

            $sql = "SELECT DISTINCT NAM_HOC, HOC_KY
            FROM Lop_Hoc_Phan
            ORDER BY NAM_HOC DESC, HOC_KY DESC
            LIMIT 1;
            ";
            $hk_nam = $model->getData($sql);
            $nam =  $hk_nam[0]["NAM_HOC"];
            $hk =  $hk_nam[0]["HOC_KY"];

            $sql = "SELECT * FROM `SinhVien_MonHocTamThoi` WHERE MSSV = '$mssv' and IDHP = '$id_dsmh'";

            $temp = $model->getData($sql);


            if(!empty($temp)){
                $sql = "DELETE FROM `SinhVien_MonHocTamThoi` WHERE MSSV = '$mssv' and IDHP = '$id_dsmh'";
                $model->update($sql);
            }
            else{
                $sql = "DELETE FROM `SinhVien_LHP` WHERE MSSV = '$mssv' and ID_DSMH = '$id_dsmh'";
                $model->update($sql);
            }

            $send = array();

            $sql = "SELECT MonHoc.ID,MonHoc.TEN,SinhVien_MonHocTamThoi.IDHP,MonHoc.TIN_CHI,(MonHoc.TIN_CHI*Khoa.TIEN_1_TIN) as hocPhi
            FROM `SinhVien_MonHocTamThoi`
            INNER JOIN Lop_Hoc_Phan on Lop_Hoc_Phan.ID_DSMH = SinhVien_MonHocTamThoi.IDHP
            INNER JOIN MonHoc on MonHoc.ID = Lop_Hoc_Phan.ID_MONHOC
            INNER JOIN SinhVien on SinhVien.MSSV = SinhVien_MonHocTamThoi.MSSV
            INNER JOIN LopHoc on SinhVien.ID_LOP = LopHoc.ID
            INNER JOIN Nganh on LopHoc.ID_NGANH = Nganh.ID
            INNER JOIN Khoa on Khoa.ID = Nganh.ID_KHOA
            WHERE SinhVien_MonHocTamThoi.MSSV = '$mssv'";

            $dsMHDK = $model->getData($sql);


            $sql = "SELECT MonHoc.ID,MonHoc.TEN,SinhVien_LHP.ID_DSMH,MonHoc.TIN_CHI,(MonHoc.TIN_CHI*Khoa.TIEN_1_TIN) as hocPhi
            FROM `SinhVien_LHP` 
            INNER JOIN Lop_Hoc_Phan on Lop_Hoc_Phan.ID_DSMH = SinhVien_LHP.ID_DSMH
            INNER JOIN MonHoc on MonHoc.ID = Lop_Hoc_Phan.ID_MONHOC
            INNER JOIN SinhVien on SinhVien.MSSV = SinhVien_LHP.MSSV
            INNER JOIN LopHoc on SinhVien.ID_LOP = LopHoc.ID
            INNER JOIN Nganh on LopHoc.ID_NGANH = Nganh.ID
            INNER JOIN Khoa on Khoa.ID = Nganh.ID_KHOA
            WHERE SinhVien_LHP.MSSV = '$mssv'  AND SinhVien_LHP.NAM = $nam AND SinhVien_LHP.HK = $hk ";
            $dsMHDL = $model->getData($sql);

            $send["dsmhdk"] = $dsMHDK;
            $send["dsmhdl"] = $dsMHDL;

            $send = json_encode($send);
            echo $send;

        }
        else{
            header("Location: http://localhost/Home/DKMH");
            exit;
        }
    }

    public function luuMH(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $model = $this->model("UserModel");
            $data = json_decode(file_get_contents('php://input'), true);
            $id_dsmh = $data["id_dsmh"] ;
            $mssv = $_SESSION["user"]["MSSV"];
            $send = array();
            $sql = "SELECT DISTINCT NAM_HOC, HOC_KY
            FROM Lop_Hoc_Phan
            ORDER BY NAM_HOC DESC, HOC_KY DESC
            LIMIT 1;
            ";
            $hk_nam = $model->getData($sql);
            $nam =  $hk_nam[0]["NAM_HOC"];
            $hk =  $hk_nam[0]["HOC_KY"];

            for($i=0;$i<count($id_dsmh);$i++){
                $id = $id_dsmh[$i];
                $sql = "INSERT INTO `SinhVien_LHP`(`MSSV`, `ID_DSMH`, `NAM`, `HK`) 
                    VALUES ('$mssv','$id','$nam','$hk')";
                $model->update($sql);

                $sql = "SELECT SL_SV FROM `Lop_Hoc_Phan` WHERE ID_DSMH = '$id'";
                $t = $model->getData($sql);
                $slg = $t[0]["SL_SV"]-1;

                $sql = "UPDATE `Lop_Hoc_Phan` SET `SL_SV`= $slg WHERE ID_DSMH = '$id'";


                $sql = "DELETE FROM `SinhVien_MonHocTamThoi` WHERE IDHP = '$id' AND MSSV = '$mssv'";
                $model->update($sql);
            }

            $sql = "SELECT MonHoc.ID,MonHoc.TEN,SinhVien_MonHocTamThoi.IDHP,MonHoc.TIN_CHI,(MonHoc.TIN_CHI*Khoa.TIEN_1_TIN) as hocPhi
            FROM `SinhVien_MonHocTamThoi`
            INNER JOIN Lop_Hoc_Phan on Lop_Hoc_Phan.ID_DSMH = SinhVien_MonHocTamThoi.IDHP
            INNER JOIN MonHoc on MonHoc.ID = Lop_Hoc_Phan.ID_MONHOC
            INNER JOIN SinhVien on SinhVien.MSSV = SinhVien_MonHocTamThoi.MSSV
            INNER JOIN LopHoc on SinhVien.ID_LOP = LopHoc.ID
            INNER JOIN Nganh on LopHoc.ID_NGANH = Nganh.ID
            INNER JOIN Khoa on Khoa.ID = Nganh.ID_KHOA
            WHERE SinhVien_MonHocTamThoi.MSSV = '$mssv'";

            $dsMHDK = $model->getData($sql);


            $sql = "SELECT MonHoc.ID,MonHoc.TEN,SinhVien_LHP.ID_DSMH,MonHoc.TIN_CHI,(MonHoc.TIN_CHI*Khoa.TIEN_1_TIN) as hocPhi
            FROM `SinhVien_LHP` 
            INNER JOIN Lop_Hoc_Phan on Lop_Hoc_Phan.ID_DSMH = SinhVien_LHP.ID_DSMH
            INNER JOIN MonHoc on MonHoc.ID = Lop_Hoc_Phan.ID_MONHOC
            INNER JOIN SinhVien on SinhVien.MSSV = SinhVien_LHP.MSSV
            INNER JOIN LopHoc on SinhVien.ID_LOP = LopHoc.ID
            INNER JOIN Nganh on LopHoc.ID_NGANH = Nganh.ID
            INNER JOIN Khoa on Khoa.ID = Nganh.ID_KHOA
            WHERE SinhVien_LHP.MSSV = '$mssv'  AND SinhVien_LHP.NAM = $nam AND SinhVien_LHP.HK = $hk ";
            $dsMHDL = $model->getData($sql);

            $send["dsmhdk"] = $dsMHDK;
            $send["dsmhdl"] = $dsMHDL;

            $send = json_encode($send);
            echo $send;


        }

    }

    public function xoaDK(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $model = $this->model("UserModel");
            $data = json_decode(file_get_contents('php://input'), true);
            $id_dsmh = $data["id_dsmh"] ;
            $mssv = $_SESSION["user"]["MSSV"];

            $send = array();
            $sql = "SELECT DISTINCT NAM_HOC, HOC_KY
            FROM Lop_Hoc_Phan
            ORDER BY NAM_HOC DESC, HOC_KY DESC
            LIMIT 1;
            ";
            $hk_nam = $model->getData($sql);
            $nam =  $hk_nam[0]["NAM_HOC"];
            $hk =  $hk_nam[0]["HOC_KY"];

            for($i=0;$i<count($id_dsmh);$i++){
                $id = $id_dsmh[$i];
                $sql = "SELECT * FROM `SinhVien_MonHocTamThoi` WHERE MSSV = '$mssv' and IDHP = '$id'";

                $temp = $model->getData($sql);
                if(!empty($temp)){
                    $sql = "DELETE FROM `SinhVien_MonHocTamThoi` WHERE MSSV = '$mssv' and IDHP = '$id'";
                    $model->update($sql);
                }
                else{
                    $sql = "DELETE FROM `SinhVien_LHP` WHERE MSSV = '$mssv' and ID_DSMH = '$id'";
                    $model->update($sql);
                }
            }

            $sql = "SELECT MonHoc.ID,MonHoc.TEN,SinhVien_MonHocTamThoi.IDHP,MonHoc.TIN_CHI,(MonHoc.TIN_CHI*Khoa.TIEN_1_TIN) as hocPhi
            FROM `SinhVien_MonHocTamThoi`
            INNER JOIN Lop_Hoc_Phan on Lop_Hoc_Phan.ID_DSMH = SinhVien_MonHocTamThoi.IDHP
            INNER JOIN MonHoc on MonHoc.ID = Lop_Hoc_Phan.ID_MONHOC
            INNER JOIN SinhVien on SinhVien.MSSV = SinhVien_MonHocTamThoi.MSSV
            INNER JOIN LopHoc on SinhVien.ID_LOP = LopHoc.ID
            INNER JOIN Nganh on LopHoc.ID_NGANH = Nganh.ID
            INNER JOIN Khoa on Khoa.ID = Nganh.ID_KHOA
            WHERE SinhVien_MonHocTamThoi.MSSV = '$mssv'";

            $dsMHDK = $model->getData($sql);


            $sql = "SELECT MonHoc.ID,MonHoc.TEN,SinhVien_LHP.ID_DSMH,MonHoc.TIN_CHI,(MonHoc.TIN_CHI*Khoa.TIEN_1_TIN) as hocPhi
            FROM `SinhVien_LHP` 
            INNER JOIN Lop_Hoc_Phan on Lop_Hoc_Phan.ID_DSMH = SinhVien_LHP.ID_DSMH
            INNER JOIN MonHoc on MonHoc.ID = Lop_Hoc_Phan.ID_MONHOC
            INNER JOIN SinhVien on SinhVien.MSSV = SinhVien_LHP.MSSV
            INNER JOIN LopHoc on SinhVien.ID_LOP = LopHoc.ID
            INNER JOIN Nganh on LopHoc.ID_NGANH = Nganh.ID
            INNER JOIN Khoa on Khoa.ID = Nganh.ID_KHOA
            WHERE SinhVien_LHP.MSSV = '$mssv'  AND SinhVien_LHP.NAM = $nam AND SinhVien_LHP.HK = $hk ";
            $dsMHDL = $model->getData($sql);

            $send["dsmhdk"] = $dsMHDK;
            $send["dsmhdl"] = $dsMHDL;

            $send = json_encode($send);
            echo $send;


        }

    }



    public function HocPhi()
    {
        $model = $this->model("UserModel");

        $queryHK = <<<HUH
        SELECT DISTINCT HK, NAM FROM SinhVien_LHP WHERE MSSV='{$_SESSION["user"]["MSSV"]}' ORDER BY NAM, HK DESC
        HUH;
        $hk = $model->getData($queryHK);

        if (!isset($params[0]) || !isset($params[1])) {
            $params[0] = $hk[0]["NAM"];
            $params[1] = $hk[0]["HK"];
        }

        array_unshift($hk, [
            "HK" => $params[1],
            "NAM" => $params[0]
        ]);

        $hk = array_unique($hk, SORT_REGULAR);


        $query = <<<WUT
        SELECT ID_MONHOC, MH.TEN, TIN_CHI FROM SinhVien_LHP SVL
        LEFT JOIN Lop_Hoc_Phan LHP on LHP.ID_DSMH = SVL.ID_DSMH and LHP.NAM_HOC = SVL.NAM and LHP.HOC_KY = SVL.HK
        LEFT JOIN MonHoc MH on MH.ID = LHP.ID_MONHOC
        LEFT JOIN Nganh N on N.ID = MH.ID_NGANH
        LEFT JOIN Khoa K on K.ID = N.ID_KHOA WHERE SVL.HK='{$params[1]}' AND SVL.NAM='{$params[0]}'
        AND MSSV={$_SESSION["user"]["MSSV"]}
        WUT;

        $data = $model->getData($query);
        foreach ($data as $index => $item) {
            $data[$index]["MMH"] = $item["ID_MONHOC"];
            $data[$index]["TENMH"] = $item["TEN"];
            $data[$index]["TINCHI"] = $item["TIN_CHI"];
        }


        $queryStatus = <<<WUT
        SELECT * FROM HocPhi
        WHERE MSSV='{$_SESSION["user"]["MSSV"]}' 
        WUT;

        $status = $model->getData($queryStatus);


        $statusMessage = "";
        if (!empty($status)) {
            $statusValue = $status[0]['ID_TRANG_THAI'];
            if ($statusValue == 1) {
                $statusMessage = "Đang chờ xử lý";
            } else if ($statusValue == 3) {
                $statusMessage = "Thành công";
            } else {
                $statusMessage = "Thất bại";
            }
        } else {
            $statusMessage = "Chưa thanh toán";
        }


        $this->view($this->homeTemplate, [
            "DSMH" => $data,
            "TT_MESSAGE" => $statusMessage,
            "HK" => $hk
        ]);
    }




    public function ThanhToan()
    {
        $model = $this->model("UserModel");

        $queryHK = <<<HUH
        SELECT DISTINCT HK, NAM FROM SinhVien_LHP WHERE MSSV='{$_SESSION["user"]["MSSV"]}' ORDER BY NAM, HK DESC
        HUH;
        $hk = $model->getData($queryHK);

        if (!isset($params[0]) || !isset($params[1])) {
            $params[0] = $hk[0]["NAM"];
            $params[1] = $hk[0]["HK"];
        }

        array_unshift($hk, [
            "HK" => $params[1],
            "NAM" => $params[0]
        ]);

        $hk = array_unique($hk, SORT_REGULAR);


        $query = <<<WUT
        SELECT ID_MONHOC, MH.TEN, TIN_CHI FROM SinhVien_LHP SVL
        LEFT JOIN Lop_Hoc_Phan LHP on LHP.ID_DSMH = SVL.ID_DSMH and LHP.NAM_HOC = SVL.NAM and LHP.HOC_KY = SVL.HK
        LEFT JOIN MonHoc MH on MH.ID = LHP.ID_MONHOC
        LEFT JOIN Nganh N on N.ID = MH.ID_NGANH
        LEFT JOIN Khoa K on K.ID = N.ID_KHOA WHERE SVL.HK='{$params[1]}' AND SVL.NAM='{$params[0]}' 
        AND  MSSV='{$_SESSION["user"]["MSSV"]}'
        WUT;

        $data = $model->getData($query);
        foreach ($data as $index => $item) {
            $data[$index]["MMH"] = $item["ID_MONHOC"];
            $data[$index]["TENMH"] = $item["TEN"];
            $data[$index]["TINCHI"] = $item["TIN_CHI"];
        }


        $this->view($this->homeTemplate, [
            "DSMH" => $data,
            "HK" => $hk
        ]);
    }

    public function XNTT()
    {
        $model = $this->model("UserModel");

        $queryHK = <<<HUH
        SELECT DISTINCT HK, NAM FROM SinhVien_LHP WHERE MSSV='{$_SESSION["user"]["MSSV"]}' ORDER BY NAM, HK DESC
        HUH;
        $hk = $model->getData($queryHK);

        if (!isset($params[0]) || !isset($params[1])) {
            $params[0] = $hk[0]["NAM"];
            $params[1] = $hk[0]["HK"];
        }

        array_unshift($hk, [
            "HK" => $params[1],
            "NAM" => $params[0]
        ]);

        $hk = array_unique($hk, SORT_REGULAR);


        $query = <<<WUT
        SELECT ID_MONHOC, MH.TEN, TIN_CHI FROM SinhVien_LHP SVL
        LEFT JOIN Lop_Hoc_Phan LHP on LHP.ID_DSMH = SVL.ID_DSMH and LHP.NAM_HOC = SVL.NAM and LHP.HOC_KY = SVL.HK
        LEFT JOIN MonHoc MH on MH.ID = LHP.ID_MONHOC
        LEFT JOIN Nganh N on N.ID = MH.ID_NGANH
        LEFT JOIN Khoa K on K.ID = N.ID_KHOA WHERE SVL.HK='{$params[1]}' AND SVL.NAM='{$params[0]}'
        AND MSSV='{$_SESSION["user"]["MSSV"]}'
        WUT;

        $data = $model->getData($query);

        $total = 0;
        $totalTC = 0;
        foreach ($data as $index => $item) {
            $total += $item["TIN_CHI"] * 350000;
            $totalTC += $item["TIN_CHI"];
        }

        $query = <<<WUT
        INSERT INTO HocPhi(TIEN_HOC_PHI, TONG_TIN_CHI, ID_HINH_THUC, ID_TRANG_THAI, MSSV)
        VALUES ({$total}, {$totalTC}, 1, 1, '{$_SESSION["user"]["MSSV"]}')
        WUT;
        $model->update($query);
        header("Location: /Home");
    }

    function EditSinhVien() {
        $params[0] = $_SESSION["user"]["MSSV"];
        $model = $this->model("SinhVienModel");

        if (isset($_GET["MSSV"])) {
            $model->replace($_GET["MSSV"], $_GET["HO_TEN"], $_GET["EMAIL"], $_GET["PHONE"], $_GET["ID_LOP"], $_GET["NAM_BAT_DAU"], $_GET["SO_THE_NH"]);
            header("Location: /Home/Home");
        }

        $lopModel = $this->model("LopModel");
        $lopData = $lopModel->getID();


        if (!isset($params[0])) {
            $this->view($this->editTemplate, [
                "Title" => "Thêm sinh viên",
                "lop" => $lopData,
            ]);
            return;
        }

        $data = $model->get($params[0])[0];
        array_unshift($lopData, [
            "ID" => $data["ID_LOP"]
        ]);

        $lopData = array_unique($lopData, SORT_REGULAR);

        $this->view($this->editTemplate, [
            "Title" => "Chỉnh sinh viên",
            "sinhVien" => $data,
            "lop" => $lopData,
        ]);

    }

    function TYC() {
        try {
            if (isset($_GET["MMH"])) {
                $model = $this->model("YCModel");
                $model->replace($_GET["MMH"], $_SESSION["user"]["MSSV"]);
            }
        }
        catch (Exception) {

        }

        header("Location: /Home/DKMH");
    }

}