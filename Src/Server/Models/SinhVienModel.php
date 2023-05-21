<?php
class SinhVienModel extends Model
{
    public function canDelete($id) {
        $query = <<<END
                    SELECT * FROM SinhVien_LHP WHERE MSSV='{$id}';
                    END;
        $data = $this->getData($query);
        return count($data) == 0;
    }

    public function delete($id) {
        $query = <<<END
            DELETE FROM SinhVien WHERE MSSV='{$id}'
        END;
        $this->update($query);
    }

    public function reset($id) {
        $query = <<<END
            UPDATE SinhVien SET PASSWORD='123' WHERE MSSV='{$id}'
        END;
        $this->update($query);
    }
    public function get($search) {
        $secondCond = "";
        if ($search !== "") {
            $secondCond = "WHERE (MSSV = '{$search}' OR HO_TEN like '%{$search}%')";
        }
        $query = <<<END
                    SELECT * FROM SinhVien {$secondCond};
                    END;
        return $this->getData($query);
    }

    public function getID() {
        $query = <<<END
                    SELECT MSSV FROM SinhVien;
                    END;
        return $this->getData($query);
    }

    public function replace($id, $name, $email, $phone, $idL, $nbd, $tnh) {
        $data = $this->get($id);
        if (count($data) > 0) {
            $query =<<<UK
            UPDATE SinhVien SET HO_TEN='{$name}', ID_LOP='{$idL}', EMAIL='{$email}', PHONE='{$phone}', NAM_BAT_DAU='{$nbd}', SO_THE_NH='{$tnh}' WHERE MSSV='{$id}'
            UK;
        }
        else {
            $query =<<<UK
            INSERT INTO SinhVien(MSSV, HO_TEN, EMAIL, PHONE, ID_LOP, PASSWORD, NAM_BAT_DAU, SO_THE_NH) 
            VALUES ('{$id}',n'{$name}', '{$email}', '{$phone}', '{$idL}', '123', '{$nbd}', '{$tnh}')
            UK;
        }
        $this->update($query);
    }

}