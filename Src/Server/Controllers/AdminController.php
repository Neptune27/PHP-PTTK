<?php

class AdminController extends Controller
{

    static string $defaultTemplate = "Admin/_default";
    static string $editTemplate = "Admin/_edit";

    function index(): void
    {
        $this->view(self::$defaultTemplate, []);
    }


    function TKB(): void {
        $q = $_GET["q"] ?? "";
        $model = $this->model("ThoiGianMonHocModel");
        $data = $model->get($q);
        foreach ($data as $index => $item) {
            $canDelete = $model->canDelete($data[$index]["ID_DSMH"]);
            $data[$index]+= [
                "CAN_DELETE" => $canDelete
            ];
        }
        foreach ($data as $index => $item) {
            $DSMH = $item["ID_DSMH"];
            $ID_NHOM = explode("_", $DSMH);
            $data[$index]["MMH"]= $ID_NHOM[0];
            $data[$index]["NHOM"]= $ID_NHOM[1];
        }


        $this->view(self::$defaultTemplate,[
            "data" => $data,
        ]);
    }

    function EditTKB($params) {
        $model = $this->model("ThoiGianMonHocModel");

        if (isset($_GET["ID_DSMH"])) {
            $model->replace($_GET["ID_DSMH"], $_GET["TIET_BAT_DAU"], $_GET["TIET_KET_THUC"], $_GET["LOP"], $_GET["TUANHOC"], $_GET["ID_GVGD"], $_GET["HK"], $_GET["NAM"], $_GET["THU"]);
            header("Location: /Admin/TKB");
        }
        $LHPModel = $this->model("LopHocPhanModel");
        $lhpData = $LHPModel->getID();

        $gvModel = $this->model("GiaoVienModel");
        $gvData = $gvModel->getID();

        if (!isset($params[0])) {
            $this->view(self::$editTemplate, [
                "Title" => "Thêm thời khóa biểu",
                "lhp" => $lhpData,
                "gv" => $gvData
            ]);
            return;
        }

        $data = $model->getCustom($params[0],$params[4],$params[3],$params[1],$params[2])[0];

        $DSMH = $data["ID_DSMH"];
        $ID_NHOM = explode("_", $DSMH);
        $data["MMH"]= $ID_NHOM[0];
        $data["NHOM"]= $ID_NHOM[1];

        array_unshift($lhpData, [
            "ID" => $data["ID_DSMH"]
        ]);

        array_unshift($gvData, [
            "ID" => $data["ID_GVGD"]
        ]);



        $lhpData = array_unique($lhpData, SORT_REGULAR);
        $gvData = array_unique($gvData, SORT_REGULAR);

        $this->view(self::$editTemplate, [
            "Title" => "Chỉnh lớp học phần",
            "lhp" => $lhpData,
            "tkb" => $data,
            "gv" => $gvData
        ]);

    }

    function DeleteTKB($params): void {
        $id = $params[0];
        $model = $this->model("ThoiGianMonHocModel");
        $model->deleteCustom($params[0],$params[4],$params[3],$params[1],$params[2]);
        header("Location: /Admin/TKB");
    }



    function LopHocPhan(): void {
        $q = $_GET["q"] ?? "";
        $model = $this->model("LopHocPhanModel");
        $data = $model->get($q);
        foreach ($data as $index => $item) {
            $canDelete = $model->canDelete($data[$index]["ID_DSMH"]);
            $data[$index]+= [
                "CAN_DELETE" => $canDelete
            ];
        }
        foreach ($data as $index => $item) {
            $DSMH = $item["ID_DSMH"];
            $ID_NHOM = explode("_", $DSMH);
            $data[$index]["MMH"]= $ID_NHOM[0];
            $data[$index]["NHOM"]= $ID_NHOM[1];
        }


        $this->view(self::$defaultTemplate,[
            "data" => $data,
        ]);
    }

    function EditLopHocPhan($params) {
        $model = $this->model("LopHocPhanModel");

        if (isset($_GET["ID_MONHOC"])) {
            $model->replace($_GET["ID_MONHOC"]."_".$_GET["NHOM"], $_GET["ID_MONHOC"], $_GET["SL_SV"], $_GET["HOC_KY"], $_GET["NAM_HOC"], $_GET["NGAY_BAT_DAU"]);
            header("Location: /Admin/LopHocPhan");
        }
        $monModel = $this->model("MonModel");
        $monData = $monModel->getID();

        if (!isset($params[0])) {
            $this->view(self::$editTemplate, [
                "Title" => "Thêm lớp học phần",
                "mon" => $monData,
            ]);
            return;
        }

        $data = $model->get($params[0])[0];

        $DSMH = $data["ID_DSMH"];
        $ID_NHOM = explode("_", $DSMH);
        $data["MMH"]= $ID_NHOM[0];
        $data["NHOM"]= $ID_NHOM[1];

        array_unshift($monData, [
            "ID" => $data["MMH"]
        ]);



        $monData = array_unique($monData, SORT_REGULAR);

        if (!isset($params[0])) {
            $this->view(self::$editTemplate, [
                "Title" => "Chỉnh lớp học phần",
                "mon" => $monData,
            ]);
            return;
        }

        $this->view(self::$editTemplate, [
            "Title" => "Chỉnh lớp học phần",
            "mon" => $monData,
            "lhp" => $data
        ]);

    }

    function DeleteLopHocPhan($params): void {
        $id = $params[0];
        $model = $this->model("MonModel");
        $model->delete($id);
        header("Location: /Admin/LopHocPhan");
    }



    function MonTienQuyet(): void {
        $q = $_GET["q"] ?? "";
        $model = $this->model("MonTienQuyetModel");
        $data = $model->get($q);
        foreach ($data as $index => $item) {
            $canDelete = $model->canDelete($data[$index]["ID_MON_HOC"]);
            $data[$index]+= [
                "CAN_DELETE" => $canDelete
            ];
        }
        $this->view(self::$defaultTemplate,[
            "data" => $data,
        ]);
    }

    function EditMonTienQuyet($params) {
        $model = $this->model("MonTienQuyetModel");

        if (isset($_GET["ID_MON_HOC"])) {
            $model->replace($_GET["ID_MON_HOC"], $_GET["ID_MON_HOC_TRUOC"]);
            header("Location: /Admin/MonTienQuyet");
        }
        $monModel = $this->model("MonModel");
        $monData1 = $monModel->getID();
        $monData2 = $monModel->getID();

        if (!isset($params[0])) {
            $this->view(self::$editTemplate, [
                "Title" => "Thêm môn tiên quyết",
                "mon" => $monData1,
                "monTruoc" => $monData2,
            ]);
            return;
        }

        $data = $model->get($params[0])[0];



        array_unshift($monData1, [
            "ID" => $data["ID_MON_HOC"]
        ]);

        array_unshift($monData2, [
            "ID" => $data["ID_MON_HOC_TRUOC"]
        ]);

        $monData1 = array_unique($monData1, SORT_REGULAR);
        $monData2 = array_unique($monData2, SORT_REGULAR);



        if (!isset($params[0])) {
            $this->view(self::$editTemplate, [
                "Title" => "Chỉnh môn tiên quyết",
                "mon" => $monData1,
                "monTruoc" => $monData2,
            ]);
            return;
        }




        $this->view(self::$editTemplate, [
            "Title" => "Chỉnh môn tiên quyết",
            "mon" => $monData1,
            "monTruoc" => $monData2,

        ]);

    }

    function DeleteMonTienQuyet($params): void {
        $id = $params[0];
        $model = $this->model("MonModel");
        $model->delete($id);
        header("Location: /Admin/GiaoVien");
    }



    function GiaoVien(): void {
        $q = $_GET["q"] ?? "";
        $model = $this->model("GiaoVienModel");
        $data = $model->get($q);
        foreach ($data as $index => $item) {
            $canDelete = $model->canDelete($data[$index]["ID"]);
            $data[$index]+= [
                "CAN_DELETE" => $canDelete
            ];
        }
        $this->view(self::$defaultTemplate,[
            "data" => $data,
        ]);
    }

    function EditGiaoVien($params) {
        $model = $this->model("GiaoVienModel");

        if (isset($_GET["ID"])) {
            $model->replace($_GET["ID"], $_GET["TEN"], $_GET["EMAIL"], $_GET["PHONE"], $_GET["ID_NGANH"], $_GET["ID_CHUC_VU"]);
            header("Location: /Admin/GiaoVien");
        }

        $nganhModel = $this->model("NganhModel");
        $nganhData = $nganhModel->getID();

        $cvModel = $this->model("CVModel");
        $cvData = $cvModel->getID();

        if (!isset($params[0])) {
            $this->view(self::$editTemplate, [
                "Title" => "Thêm giáo viên",
                "nganh" => $nganhData,
                "cv" => $cvData
            ]);
            return;
        }

        $data = $model->get($params[0])[0];
        array_unshift($nganhData, [
            "ID" => $data["ID_NGANH"]
        ]);

        $nganhData = array_unique($nganhData, SORT_REGULAR);

        $this->view(self::$editTemplate, [
            "Title" => "Chỉnh giáo viên",
            "giaoVien" => $data,
            "nganh" => $nganhData,
            "cv" => $cvData
        ]);

    }

    function DeleteGiaoVien($params): void {
        $id = $params[0];
        $model = $this->model("MonModel");
        $model->delete($id);
        header("Location: /Admin/GiaoVien");
    }



    function SinhVien(): void {
        $q = $_GET["q"] ?? "";
        $model = $this->model("SinhVienModel");
        $data = $model->get($q);
        foreach ($data as $index => $item) {
            $canDelete = $model->canDelete($data[$index]["MSSV"]);
            $data[$index]+= [
                "CAN_DELETE" => $canDelete
            ];
        }
        $this->view(self::$defaultTemplate,[
            "data" => $data,
        ]);
    }

    function EditSinhVien($params) {
        $model = $this->model("SinhVienModel");

        if (isset($_GET["MSSV"])) {
            $model->replace($_GET["MSSV"], $_GET["HO_TEN"], $_GET["EMAIL"], $_GET["PHONE"], $_GET["ID_LOP"], $_GET["NAM_BAT_DAU"], $_GET["SO_THE_NH"]);
            header("Location: /Admin/SinhVien");
        }

        $lopModel = $this->model("LopModel");
        $lopData = $lopModel->getID();


        if (!isset($params[0])) {
            $this->view(self::$editTemplate, [
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

        $this->view(self::$editTemplate, [
            "Title" => "Chỉnh sinh viên",
            "sinhVien" => $data,
            "lop" => $lopData,
        ]);

    }

    function DeleteSinhVien($params): void {
        $id = $params[0];
        $model = $this->model("SinhVienModel");
        $model->delete($id);
        header("Location: /Admin/SinhVien");
    }

    function ResetSinhVien($params): void {
        $id = $params[0];
        $model = $this->model("SinhVienModel");
        $model->reset($id);
        header("Location: /Admin/SinhVien");
    }




    function Mon(): void {
        $q = $_GET["q"] ?? "";
        $model = $this->model("MonModel");
        $data = $model->get($q);
        foreach ($data as $index => $item) {
            $canDelete = $model->canDelete($data[$index]["ID"]);
            $data[$index]+= [
                "CAN_DELETE" => $canDelete
            ];
        }
        $this->view(self::$defaultTemplate,[
            "data" => $data,
        ]);
    }

    function EditMon($params) {
        $model = $this->model("MonModel");

        if (isset($_GET["ID"])) {
            $model->replace($_GET["ID"], $_GET["TEN"], $_GET["ID_NGANH"], $_GET["TIN_CHI"]);
            header("Location: /Admin/Mon");
        }


        $nganhModel = $this->model("NganhModel");
        $nganhData = $nganhModel->getID();
        if (!isset($params[0])) {
            $this->view(self::$editTemplate, [
                "Title" => "Thêm lớp",
                "nganh" => $nganhData
            ]);
            return;
        }

        $data = $model->get($params[0])[0];
        array_unshift($nganhData, [
            "ID" => $data["ID_NGANH"]
        ]);

        $nganhData = array_unique($nganhData, SORT_REGULAR);

//        print_r($nganhData);
        $this->view(self::$editTemplate, [
            "Title" => "Chỉnh lớp",
            "mon" => $data,
            "nganh" => $nganhData
        ]);

    }

    function DeleteMon($params): void {
        $id = $params[0];
        $model = $this->model("MonModel");
        $model->delete($id);
        header("Location: /Admin/Mon");
    }




    function Lop(): void {
        $q = $_GET["q"] ?? "";
        $model = $this->model("LopModel");
        $data = $model->get($q);
        foreach ($data as $index => $item) {
            $canDelete = $model->canDelete($data[$index]["ID"]);
            $data[$index]+= [
                "CAN_DELETE" => $canDelete
            ];
        }
        $this->view(self::$defaultTemplate,[
            "data" => $data,
        ]);
    }

    function EditLop($params) {
        $model = $this->model("LopModel");

        if (isset($_GET["ID"])) {
            $model->replace($_GET["ID"], $_GET["TEN"], $_GET["ID_NGANH"]);
            header("Location: /Admin/Lop");
        }


        $nganhModel = $this->model("NganhModel");
        $nganhData = $nganhModel->getID();
        if (!isset($params[0])) {
            $this->view(self::$editTemplate, [
                "Title" => "Chỉnh ngành",
                "nganh" => $nganhData
            ]);
            return;
        }

        $data = $model->get($params[0])[0];
        array_unshift($nganhData, [
            "ID" => $data["ID_NGANH"]
        ]);

        $nganhData = array_unique($nganhData, SORT_REGULAR);

//        print_r($nganhData);
        $this->view(self::$editTemplate, [
            "Title" => "Chỉnh ngành",
            "lop" => $data,
            "nganh" => $nganhData
        ]);

    }

    function DeleteLop($params): void {
        $id = $params[0];
        $model = $this->model("LopModel");
        $model->delete($id);
        header("Location: /Admin/Lop");
    }




    function Khoa(): void {
        $q = $_GET["q"] ?? "";
        $model = $this->model("KhoaModel");
        $data = $model->get($q);
        foreach ($data as $index => $item) {
            $canDelete = $model->canDelete($data[$index]["ID"]);
            $data[$index]+= [
                "CAN_DELETE" => $canDelete
            ];
        }
        $this->view(self::$defaultTemplate,[
            "data" => $data,
        ]);
    }

    function EditKhoa($params) {
        $model = $this->model("KhoaModel");

        if (isset($_GET["ID"])) {
            $model->replace($_GET["ID"], $_GET["TEN"], $_GET["TIEN_1_TIN"]);
            header("Location: /Admin/Khoa");
        }


        if (!isset($params[0])) {
            $this->view(self::$editTemplate, [
                "Title" => "Chỉnh ngành",
            ]);
            return;
        }

        $data = $model->get($params[0])[0];

        $this->view(self::$editTemplate, [
            "Title" => "Chỉnh ngành",
            "khoa" => $data
        ]);
    }

    function DeleteKhoa($params): void {
        $id = $params[0];
        $model = $this->model("NganhModel");
        $model->delete($id);
        header("Location: /Admin/Nganh");
    }




    function Nganh(): void {
        $q = $_GET["q"] ?? "";
        $model = $this->model("NganhModel");
        $data = $model->get($q);
        foreach ($data as $index => $item) {
            $canDelete = $model->canDelete($data[$index]["ID"]);
            $data[$index]+= [
                "CAN_DELETE" => $canDelete
            ];
        }
        $this->view(self::$defaultTemplate,[
            "data" => $data,
        ]);
    }

    function EditNganh($params) {
        $model = $this->model("NganhModel");

        if (isset($_GET["ID"])) {
            $model->replace($_GET["ID"], $_GET["TEN"], $_GET["ID_KHOA"]);
            header("Location: /Admin/Nganh");
        }


        $khoaModel = $this->model("KhoaModel");
        $khoaData = $khoaModel->getID();
        if (!isset($params[0])) {
            $this->view(self::$editTemplate, [
                "Title" => "Chỉnh ngành",
                "khoa" => $khoaData
            ]);
            return;
        }

        $khoaModel = $this->model("KhoaModel");
        $khoaData = $khoaModel->getID();

        $data = $model->get($params[0])[0];
        array_unshift($khoaData, [
            "ID" => $data["ID_KHOA"]
        ]);
        $khoaData = array_unique($khoaData, SORT_REGULAR);

        $this->view(self::$editTemplate, [
            "Title" => "Chỉnh ngành",
            "nganh" => $data,
            "khoa" => $khoaData
        ]);
    }

    function DeleteNganh($params): void {
        $id = $params[0];
        $model = $this->model("NganhModel");
        $model->delete($id);
        header("Location: /Admin/Nganh");
    }
}