<?php
class LopHocPhanModel extends Model
{
    public function canDelete($id) {
        $query = <<<END
                    SELECT * FROM SinhVien_LHP WHERE ID_DSMH='{$id}';
                    END;
        $data = $this->getData($query);
        return count($data) == 0;
    }

    public function delete($id) {
        $query = <<<END
            DELETE FROM Lop_Hoc_Phan WHERE ID_DSMH='{$id}'
        END;
        $this->update($query);
    }
    public function get($search) {
        $secondCond = "";
        if ($search !== "") {
            $secondCond = "WHERE (ID_DSMH = '{$search}' OR ID_MONHOC = '{$search}')";
        }
        $query = <<<END
                    SELECT * FROM Lop_Hoc_Phan {$secondCond} ORDER BY NAM_HOC DESC, HOC_KY DESC;
                    END;
        return $this->getData($query);
    }

    public function getID() {
        $query = <<<END
                    SELECT DISTINCT ID_DSMH as ID FROM Lop_Hoc_Phan;
                    END;
        return $this->getData($query);
    }

    public function replace($id, $idMH, $sl, $hk, $nam, $ngayBatDau) {
        $data = $this->get($id);
        if (count($data) > 0) {
            $query =<<<UK
            UPDATE Lop_Hoc_Phan SET ID_MONHOC='{$idMH}', SL_SV='{$sl}', HOC_KY='{$hk}', NAM_HOC='{$nam}', NGAY_BAT_DAU='{$ngayBatDau}' WHERE ID_DSMH='{$id}'
            UK;
        }
        else {
            $query =<<<UK
            INSERT INTO Lop_Hoc_Phan(ID_DSMH, ID_MONHOC, SL_SV, HOC_KY, NAM_HOC, NGAY_BAT_DAU) 
            VALUES ('{$id}','{$idMH}', '{$sl}', '{$hk}', '{$nam}','{$ngayBatDau}')
            UK;
        }
        $this->update($query);
    }

}