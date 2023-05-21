<?php
class GiaoVienModel extends Model
{
    public function canDelete($id) {
        $query = <<<END
                    SELECT * FROM ThoiGianMonHoc WHERE ID_GVGD='{$id}';
                    END;
        $data = $this->getData($query);
        return count($data) == 0;
    }

    public function delete($id) {
        $query = <<<END
            DELETE FROM GiaoVien WHERE ID='{$id}'
        END;
        $this->update($query);
    }
    public function get($search) {
        $secondCond = "";
        if ($search !== "") {
            $secondCond = "WHERE (ID = '{$search}' OR TEN like '%{$search}%')";
        }
        $query = <<<END
                    SELECT * FROM GiaoVien {$secondCond};
                    END;
        return $this->getData($query);
    }

    public function getID() {
        $query = <<<END
                    SELECT ID FROM GiaoVien;
                    END;
        return $this->getData($query);
    }

    public function replace($id, $name, $email, $phone, $idN, $idCV) {
        $data = $this->get($id);
        if (count($data) > 0) {
            $query =<<<UK
            UPDATE GiaoVien SET TEN='{$name}', ID_NGANH='{$idN}', EMAIL='{$email}', PHONE='{$phone}', ID_CHUC_VU='{$idCV}' WHERE ID='{$id}'
            UK;
        }
        else {
            $query =<<<UK
            INSERT INTO GiaoVien(ID, TEN, ID_NGANH, EMAIL, PHONE, ID_CHUC_VU) VALUES ('{$id}',n'{$name}', '{$idN}', '{$email}', '{$phone}', '{$idCV}')
            UK;
        }
        $this->update($query);
    }

}