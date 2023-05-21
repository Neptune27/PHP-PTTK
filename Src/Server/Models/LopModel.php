<?php
class LopModel extends Model
{
    public function canDelete($id) {
        $query = <<<END
                    SELECT * FROM SinhVien WHERE ID_LOP='{$id}';
                    END;
        $data = $this->getData($query);
        return count($data) == 0;
    }

    public function delete($id) {
        $query = <<<END
            DELETE FROM LopHoc WHERE ID='{$id}'
        END;
        $this->update($query);
    }
    public function get($search) {
        $secondCond = "";
        if ($search !== "") {
            $secondCond = "WHERE (ID = '{$search}' OR TEN like '%{$search}%')";
        }
        $query = <<<END
                    SELECT * FROM LopHoc {$secondCond};
                    END;
        return $this->getData($query);
    }

    public function getID() {
        $query = <<<END
                    SELECT ID FROM LopHoc;
                    END;
        return $this->getData($query);
    }

    public function replace($id, $name, $idN) {
        $data = $this->get($id);
        if (count($data) > 0) {
            $query =<<<UK
            UPDATE LopHoc SET TEN='{$name}', ID_NGANH='{$idN}' WHERE ID='{$id}'
            UK;
        }
        else {
            $query =<<<UK
            INSERT INTO LopHoc(ID, TEN, ID_NGANH) VALUES ('{$id}','{$name}', '{$idN}')
            UK;
        }
        $this->update($query);
    }

}