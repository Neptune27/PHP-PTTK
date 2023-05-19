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

    function Timetable() {
        $this->view($this->homeTemplate, []);
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
        print_r($data);
                
        foreach ($data as $index => $item) {
            $DSMH = $item["ID_DSMH"];
            $ID_NHOM = explode("_", $DSMH);
            $data[$index]["MMH"]= $ID_NHOM[0];
            $data[$index]["NHOM"]= $ID_NHOM[1];
        }
       print_r($data);
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
        FROM lop_hoc_phan
        ORDER BY NAM_HOC DESC, HOC_KY DESC
        LIMIT 1;
        ";
        $hk_nam = $model->getData($sql);
        $nam =  $hk_nam[0]["NAM_HOC"];
        $hk =  $hk_nam[0]["HOC_KY"];
        
        
        $sql = "SELECT ID_MONHOC,MH.TEN,LHP.ID_DSMH,MH.TIN_CHI,LHP.SL_SV,TGMH.THU,TGMH.TIET_BAT_DAU,
        TGMH.TIET_KET_THUC,TGMH.LOP,giaovien.TEN as tenGV,TGMH.TUANHOC,COALESCE((LHP.SL_SV - slgDK), LHP.SL_SV) AS conLai  
        FROM Lop_Hoc_Phan LHP
        JOIN ThoiGianMonHoc TGMH on LHP.ID_DSMH = TGMH.ID_DSMH and LHP.NAM_HOC = TGMH.NAM and LHP.HOC_KY = TGMH.HK
        JOIN giaovien on TGMH.ID_GVGD = giaovien.ID
        LEFT JOIN MonHoc MH on MH.ID = LHP.ID_MONHOC
        LEFT JOIN (
            SELECT ID_DSMH,COUNT(ID_DSMH) as slgDK
            FROM sinhvien_lhp
            WHERE sinhvien_lhp.NAM = $nam and sinhvien_lhp.HK = $hk
        ) AS svlhp on svlhp.ID_DSMH = LHP.ID_DSMH
        WHERE TGMH.HK = $hk and TGMH.NAM = $nam ";
        if(!empty($ma)){
            $sql = $sql." and ID_MONHOC ='$ma'";
        }
        $data = $model->getData($sql);
        
        $mssv = "3121560037";
        
        $sql = "SELECT monhoc.ID,monhoc.TEN,sinhvien_monhoctamthoi.IDHP,monhoc.TIN_CHI,(monhoc.TIN_CHI*khoa.TIEN_1_TIN) as hocPhi
        FROM `sinhvien_monhoctamthoi`
        INNER JOIN lop_hoc_phan on lop_hoc_phan.ID_DSMH = IDHP
        INNER JOIN monhoc on monhoc.ID = lop_hoc_phan.ID_MONHOC
        INNER JOIN sinhvien on sinhvien.MSSV = sinhvien_monhoctamthoi.MSSV
        INNER JOIN lophoc on sinhvien.ID_LOP = lophoc.ID
        INNER JOIN nganh on lophoc.ID_NGANH = nganh.ID
        INNER JOIN khoa on khoa.ID = nganh.ID_KHOA
        WHERE sinhvien_monhoctamthoi.MSSV = '$mssv'";
        
        $dsMHDK = $model->getData($sql);
        
        $sql = "SELECT monhoc.ID,monhoc.TEN,sinhvien_lhp.ID_DSMH,monhoc.TIN_CHI,(monhoc.TIN_CHI*khoa.TIEN_1_TIN) as hocPhi
        FROM `sinhvien_lhp` 
        INNER JOIN lop_hoc_phan on lop_hoc_phan.ID_DSMH = sinhvien_lhp.ID_DSMH
        INNER JOIN monhoc on monhoc.ID = lop_hoc_phan.ID_MONHOC
        INNER JOIN sinhvien on sinhvien.MSSV = sinhvien_lhp.MSSV
        INNER JOIN lophoc on sinhvien.ID_LOP = lophoc.ID
        INNER JOIN nganh on lophoc.ID_NGANH = nganh.ID
        INNER JOIN khoa on khoa.ID = nganh.ID_KHOA
        WHERE sinhvien_lhp.MSSV = '$mssv'  AND sinhvien_lhp.NAM = $nam AND sinhvien_lhp.HK = $hk ";
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
            $mssv = "3121560037";
            
            $send = array();
            $sql = "SELECT DISTINCT NAM_HOC, HOC_KY
            FROM lop_hoc_phan
            ORDER BY NAM_HOC DESC, HOC_KY DESC
            LIMIT 1;
            ";
            $hk_nam = $model->getData($sql);
            $nam =  $hk_nam[0]["NAM_HOC"];
            $hk =  $hk_nam[0]["HOC_KY"];
            
            
            //LẤY THÔNG TIN VỀ MÔN HỌC 
            $sql = "SELECT * FROM `lop_hoc_phan` 
            INNER JOIN thoigianmonhoc on thoigianmonhoc.ID_DSMH = lop_hoc_phan.ID_DSMH 
            INNER JOIN monhoc on lop_hoc_phan.ID_MONHOC = monhoc.id 
            WHERE lop_hoc_phan.ID_DSMH = '$id_dsmh'";
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
            
            $sql  = "SELECT * FROM `montienquyet` WHERE ID_MON_HOC = '$idmh'";
            $temp = $model->getData($sql);
            
            if(!empty($temp)){
                $id_mht = $temp[0]["ID_MON_HOC_TRUOC"];
                $sql = "SELECT * FROM `sinhvien_lhp` 
                INNER JOIN lop_hoc_phan on sinhvien_lhp.ID_DSMH = lop_hoc_phan.ID_DSMH
                WHERE  MSSV = '$mssv' AND lop_hoc_phan.ID_MONHOC = '$idmh' AND (NAM = !2023 or HK != 2) ";
                $t = $model->getData($sql);
                if(empty($t)){
                    $send["error"] = "Can hoc mon tien quyet ";
                    $kti = 0;
                }
            }
            
            // KIỂM TRA TRÙNG TKB
            for($i=0;$i<count($tietBD);$i++){
                
                $sql = "SELECT *
                FROM sinhvien_monhoctamthoi
                INNER JOIN thoigianmonhoc ON thoigianmonhoc.ID_DSMH = sinhvien_monhoctamthoi.IDHP
                WHERE thoigianmonhoc.THU = ".$thu[$i]." AND thoigianmonhoc.HK = $hk AND thoigianmonhoc.NAM = $nam AND 
                (thoigianmonhoc.TIET_BAT_DAU <= ".$tietKT[$i]." AND thoigianmonhoc.TIET_KET_THUC >= ".$tietBD[$i].")";
                $temp = $model->getData($sql);
                if(!empty($temp)){
                    echo $sql;
                    $kti = 0;
                }
            }
            
            //KIỂM TRA TÍN CHỈ TỐI ĐA
            $sql = "SELECT IFNULL(sum(monhoc.TIN_CHI), 0) as soTC FROM `sinhvien_lhp` 
            INNER JOIN lop_hoc_phan on lop_hoc_phan.ID_DSMH = sinhvien_lhp.ID_DSMH
            INNER JOIN monhoc on monhoc.ID = lop_hoc_phan.ID_MONHOC
            WHERE sinhvien_lhp.MSSV = '$mssv'";
            $temp = $model->getData($sql);
            $soTC = $temp[0]["soTC"];
            if (!empty($soTC) && $soTC+$tc >26) {
                $send["error"] = "So Tin CHi da vuot qua toi da";
                $kti = 0;
            }
            
            $sql = "SELECT IFNULL(sum(monhoc.TIN_CHI), 0) as soTC FROM sinhvien_monhoctamthoi 
            INNER JOIN lop_hoc_phan on lop_hoc_phan.ID_DSMH = sinhvien_monhoctamthoi.IDHP
            INNER JOIN monhoc on monhoc.ID = lop_hoc_phan.ID_MONHOC
            WHERE sinhvien_monhoctamthoi.MSSV = '$mssv'";
            $temp = $model->getData($sql);
            $soTC = $temp[0]["soTC"];
            if (!empty($soTC) && $soTC+$tc >26) {
                $send["error"] = "So Tin CHi da vuot qua toi da";
                $kti = 0;
            }
            
            
            //kIỂM TRA TRÙNG MÃ HP THÌ TỰ ĐỘNG THAY THẾ
            
            $sql = "SELECT * FROM `sinhvien_lhp`
            INNER JOIN lop_hoc_phan on lop_hoc_phan.ID_DSMH = sinhvien_lhp.ID_DSMH
            INNER JOIN monhoc on  monhoc.ID = lop_hoc_phan.ID_MONHOC
            WHERE monhoc.ID = '$idmh'";
            $temp = $model->getData($sql);
            if(!empty($temp) && empty($send)){
                $sql = "DELETE FROM `sinhvien_lhp` WHERE ID_DSMH = '$id_dsmh' and MSSV = '$mssv' and HK = $hk and NAM = $nam";
                $model->update($sql);
            }
            
            $sql ="SELECT * FROM `sinhvien_monhoctamthoi`
            INNER JOIN lop_hoc_phan on lop_hoc_phan.ID_DSMH = sinhvien_monhoctamthoi.IDHP
            INNER JOIN monhoc on  monhoc.ID = lop_hoc_phan.ID_MONHOC
            WHERE monhoc.ID = '$idmh'";
            $temp = $model->getData($sql);
            if(!empty($temp) && empty($send)){
                $sql = "DELETE FROM `sinhvien_monhoctamthoi` WHERE IDHP = '".$temp[0]["IDHP"]."' and MSSV = '$mssv'";
                $model->update($sql);
            }
            
            
            
            if(empty($send) && $kti == 1){
                $sql = "INSERT INTO `sinhvien_monhoctamthoi`(`MSSV`, `IDHP`) VALUES ('$mssv','$id_dsmh')";
                
                $model->update($sql);
            }
            
            $sql = "SELECT monhoc.ID,monhoc.TEN,sinhvien_monhoctamthoi.IDHP,monhoc.TIN_CHI,(monhoc.TIN_CHI*khoa.TIEN_1_TIN) as hocPhi
            FROM `sinhvien_monhoctamthoi`
            INNER JOIN lop_hoc_phan on lop_hoc_phan.ID_DSMH = sinhvien_monhoctamthoi.IDHP
            INNER JOIN monhoc on monhoc.ID = lop_hoc_phan.ID_MONHOC
            INNER JOIN sinhvien on sinhvien.MSSV = sinhvien_monhoctamthoi.MSSV
            INNER JOIN lophoc on sinhvien.ID_LOP = lophoc.ID
            INNER JOIN nganh on lophoc.ID_NGANH = nganh.ID
            INNER JOIN khoa on khoa.ID = nganh.ID_KHOA
            WHERE sinhvien_monhoctamthoi.MSSV = '$mssv'";
            
            $dsMHDK = $model->getData($sql);
            
            
            $sql = "SELECT monhoc.ID,monhoc.TEN,sinhvien_lhp.ID_DSMH,monhoc.TIN_CHI,(monhoc.TIN_CHI*khoa.TIEN_1_TIN) as hocPhi
            FROM `sinhvien_lhp` 
            INNER JOIN lop_hoc_phan on lop_hoc_phan.ID_DSMH = sinhvien_lhp.ID_DSMH
            INNER JOIN monhoc on monhoc.ID = lop_hoc_phan.ID_MONHOC
            INNER JOIN sinhvien on sinhvien.MSSV = sinhvien_lhp.MSSV
            INNER JOIN lophoc on sinhvien.ID_LOP = lophoc.ID
            INNER JOIN nganh on lophoc.ID_NGANH = nganh.ID
            INNER JOIN khoa on khoa.ID = nganh.ID_KHOA
            WHERE sinhvien_lhp.MSSV = '$mssv' AND sinhvien_lhp.NAM = $nam AND sinhvien_lhp.HK = $hk ";
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
            $mssv = "3121560037";

            $sql = "SELECT DISTINCT NAM_HOC, HOC_KY
            FROM lop_hoc_phan
            ORDER BY NAM_HOC DESC, HOC_KY DESC
            LIMIT 1;
            ";
            $hk_nam = $model->getData($sql);
            $nam =  $hk_nam[0]["NAM_HOC"];
            $hk =  $hk_nam[0]["HOC_KY"];
            
            $sql = "SELECT * FROM `sinhvien_monhoctamthoi` WHERE MSSV = '$mssv' and IDHP = '$id_dsmh'";
            
            $temp = $model->getData($sql);
            
            
            if(!empty($temp)){
                $sql = "DELETE FROM `sinhvien_monhoctamthoi` WHERE MSSV = '$mssv' and IDHP = '$id_dsmh'";
                $model->update($sql);
            }
            else{
                $sql = "DELETE FROM `sinhvien_lhp` WHERE MSSV = '$mssv' and ID_DSMH = '$id_dsmh'";
                $model->update($sql);   
            }
            
            $send = array();
            
            $sql = "SELECT monhoc.ID,monhoc.TEN,sinhvien_monhoctamthoi.IDHP,monhoc.TIN_CHI,(monhoc.TIN_CHI*khoa.TIEN_1_TIN) as hocPhi
            FROM `sinhvien_monhoctamthoi`
            INNER JOIN lop_hoc_phan on lop_hoc_phan.ID_DSMH = sinhvien_monhoctamthoi.IDHP
            INNER JOIN monhoc on monhoc.ID = lop_hoc_phan.ID_MONHOC
            INNER JOIN sinhvien on sinhvien.MSSV = sinhvien_monhoctamthoi.MSSV
            INNER JOIN lophoc on sinhvien.ID_LOP = lophoc.ID
            INNER JOIN nganh on lophoc.ID_NGANH = nganh.ID
            INNER JOIN khoa on khoa.ID = nganh.ID_KHOA
            WHERE sinhvien_monhoctamthoi.MSSV = '$mssv'";
            
            $dsMHDK = $model->getData($sql);
            
            
            $sql = "SELECT monhoc.ID,monhoc.TEN,sinhvien_lhp.ID_DSMH,monhoc.TIN_CHI,(monhoc.TIN_CHI*khoa.TIEN_1_TIN) as hocPhi
            FROM `sinhvien_lhp` 
            INNER JOIN lop_hoc_phan on lop_hoc_phan.ID_DSMH = sinhvien_lhp.ID_DSMH
            INNER JOIN monhoc on monhoc.ID = lop_hoc_phan.ID_MONHOC
            INNER JOIN sinhvien on sinhvien.MSSV = sinhvien_lhp.MSSV
            INNER JOIN lophoc on sinhvien.ID_LOP = lophoc.ID
            INNER JOIN nganh on lophoc.ID_NGANH = nganh.ID
            INNER JOIN khoa on khoa.ID = nganh.ID_KHOA
            WHERE sinhvien_lhp.MSSV = '$mssv'  AND sinhvien_lhp.NAM = $nam AND sinhvien_lhp.HK = $hk ";
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
            $mssv = "3121560037";
            
            $send = array();
            $sql = "SELECT DISTINCT NAM_HOC, HOC_KY
            FROM lop_hoc_phan
            ORDER BY NAM_HOC DESC, HOC_KY DESC
            LIMIT 1;
            ";
            $hk_nam = $model->getData($sql);
            $nam =  $hk_nam[0]["NAM_HOC"];
            $hk =  $hk_nam[0]["HOC_KY"];
            
            for($i=0;$i<count($id_dsmh);$i++){
                $id = $id_dsmh[$i];
                $sql = "INSERT INTO `sinhvien_lhp`(`MSSV`, `ID_DSMH`, `NAM`, `HK`) 
                    VALUES ('$mssv','$id','$nam','$hk')";
                $model->update($sql);
                
                $sql = "SELECT SL_SV FROM `lop_hoc_phan` WHERE ID_DSMH = '$id'";
                $t = $model->getData($sql);
                $slg = $t[0]["SL_SV"]-1;
                
                $sql = "UPDATE `lop_hoc_phan` SET `SL_SV`= $slg WHERE ID_DSMH = '$id'";
                
                
                $sql = "DELETE FROM `sinhvien_monhoctamthoi` WHERE IDHP = '$id' AND MSSV = '$mssv'";
                $model->update($sql);
            }
            
            $sql = "SELECT monhoc.ID,monhoc.TEN,sinhvien_monhoctamthoi.IDHP,monhoc.TIN_CHI,(monhoc.TIN_CHI*khoa.TIEN_1_TIN) as hocPhi
            FROM `sinhvien_monhoctamthoi`
            INNER JOIN lop_hoc_phan on lop_hoc_phan.ID_DSMH = sinhvien_monhoctamthoi.IDHP
            INNER JOIN monhoc on monhoc.ID = lop_hoc_phan.ID_MONHOC
            INNER JOIN sinhvien on sinhvien.MSSV = sinhvien_monhoctamthoi.MSSV
            INNER JOIN lophoc on sinhvien.ID_LOP = lophoc.ID
            INNER JOIN nganh on lophoc.ID_NGANH = nganh.ID
            INNER JOIN khoa on khoa.ID = nganh.ID_KHOA
            WHERE sinhvien_monhoctamthoi.MSSV = '$mssv'";
            
            $dsMHDK = $model->getData($sql);
            
            
            $sql = "SELECT monhoc.ID,monhoc.TEN,sinhvien_lhp.ID_DSMH,monhoc.TIN_CHI,(monhoc.TIN_CHI*khoa.TIEN_1_TIN) as hocPhi
            FROM `sinhvien_lhp` 
            INNER JOIN lop_hoc_phan on lop_hoc_phan.ID_DSMH = sinhvien_lhp.ID_DSMH
            INNER JOIN monhoc on monhoc.ID = lop_hoc_phan.ID_MONHOC
            INNER JOIN sinhvien on sinhvien.MSSV = sinhvien_lhp.MSSV
            INNER JOIN lophoc on sinhvien.ID_LOP = lophoc.ID
            INNER JOIN nganh on lophoc.ID_NGANH = nganh.ID
            INNER JOIN khoa on khoa.ID = nganh.ID_KHOA
            WHERE sinhvien_lhp.MSSV = '$mssv'  AND sinhvien_lhp.NAM = $nam AND sinhvien_lhp.HK = $hk ";
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
            $mssv = "3121560037";
            
            $send = array();
            $sql = "SELECT DISTINCT NAM_HOC, HOC_KY
            FROM lop_hoc_phan
            ORDER BY NAM_HOC DESC, HOC_KY DESC
            LIMIT 1;
            ";
            $hk_nam = $model->getData($sql);
            $nam =  $hk_nam[0]["NAM_HOC"];
            $hk =  $hk_nam[0]["HOC_KY"];
            
            for($i=0;$i<count($id_dsmh);$i++){
                $id = $id_dsmh[$i];
                $sql = "SELECT * FROM `sinhvien_monhoctamthoi` WHERE MSSV = '$mssv' and IDHP = '$id'";
            
                $temp = $model->getData($sql);
                if(!empty($temp)){
                    $sql = "DELETE FROM `sinhvien_monhoctamthoi` WHERE MSSV = '$mssv' and IDHP = '$id'";
                    $model->update($sql);
                }
                else{
                    $sql = "DELETE FROM `sinhvien_lhp` WHERE MSSV = '$mssv' and ID_DSMH = '$id'";
                    $model->update($sql);   
                }
            }
            
            $sql = "SELECT monhoc.ID,monhoc.TEN,sinhvien_monhoctamthoi.IDHP,monhoc.TIN_CHI,(monhoc.TIN_CHI*khoa.TIEN_1_TIN) as hocPhi
            FROM `sinhvien_monhoctamthoi`
            INNER JOIN lop_hoc_phan on lop_hoc_phan.ID_DSMH = sinhvien_monhoctamthoi.IDHP
            INNER JOIN monhoc on monhoc.ID = lop_hoc_phan.ID_MONHOC
            INNER JOIN sinhvien on sinhvien.MSSV = sinhvien_monhoctamthoi.MSSV
            INNER JOIN lophoc on sinhvien.ID_LOP = lophoc.ID
            INNER JOIN nganh on lophoc.ID_NGANH = nganh.ID
            INNER JOIN khoa on khoa.ID = nganh.ID_KHOA
            WHERE sinhvien_monhoctamthoi.MSSV = '$mssv'";
            
            $dsMHDK = $model->getData($sql);
            
            
            $sql = "SELECT monhoc.ID,monhoc.TEN,sinhvien_lhp.ID_DSMH,monhoc.TIN_CHI,(monhoc.TIN_CHI*khoa.TIEN_1_TIN) as hocPhi
            FROM `sinhvien_lhp` 
            INNER JOIN lop_hoc_phan on lop_hoc_phan.ID_DSMH = sinhvien_lhp.ID_DSMH
            INNER JOIN monhoc on monhoc.ID = lop_hoc_phan.ID_MONHOC
            INNER JOIN sinhvien on sinhvien.MSSV = sinhvien_lhp.MSSV
            INNER JOIN lophoc on sinhvien.ID_LOP = lophoc.ID
            INNER JOIN nganh on lophoc.ID_NGANH = nganh.ID
            INNER JOIN khoa on khoa.ID = nganh.ID_KHOA
            WHERE sinhvien_lhp.MSSV = '$mssv'  AND sinhvien_lhp.NAM = $nam AND sinhvien_lhp.HK = $hk ";
            $dsMHDL = $model->getData($sql);
            
            $send["dsmhdk"] = $dsMHDK;
            $send["dsmhdl"] = $dsMHDL;  
            
            $send = json_encode($send);
            echo $send;
            
            
        }
        
    }

}