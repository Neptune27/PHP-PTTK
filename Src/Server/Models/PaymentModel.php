<?php
class PaymentModel extends Model
{
    public function canDelete($id) {
        $query = <<<END
                    SELECT * FROM HocPhi WHERE ID='{$id}' AND ID_TRANG_THAI!=1;
                    END;
        $data = $this->getData($query);
        return count($data) == 0;
    }

    public function delete($id) {
        $query = <<<END
            DELETE FROM HocPhi WHERE ID='{$id}'
        END;
        $this->update($query);
    }
    public function get($search) {
        $secondCond = "";
        if ($search !== "") {
            $secondCond = "WHERE (ID = '{$search}')";
        }
        $query = <<<END
                    SELECT * FROM HocPhi {$secondCond};
                    END;
        return $this->getData($query);
    }

    public function getID() {
        $query = <<<END
                    SELECT ID FROM HocPhi;
                    END;
        return $this->getData($query);
    }

    public function replace($id, $mssv, $idtt, $idhh, $thp, $ttc) {
        $data = $this->get($id);
        if (count($data) > 0) {
            $query =<<<UK
            UPDATE HocPhi SET MSSV='{$mssv}', ID_TRANG_THAI='{$idtt}', ID_HINH_THUC='{$idhh}', TIEN_HOC_PHI='{$thp}', TONG_TIN_CHI='{$ttc}' WHERE ID='{$id}'
            UK;
        }
        else {
            $query =<<<UK
            INSERT INTO HocPhi(TIEN_HOC_PHI, TONG_TIN_CHI, ID_HINH_THUC, ID_TRANG_THAI, MSSV) 
            VALUES ('{$thp}','{$ttc}', '{$idhh}', '{$idtt}', '{$mssv}')
            UK;
        }
        $this->update($query);
    }

}