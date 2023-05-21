<?php
class TKBModel extends Model
{
    public function canDelete($id) {
        $query = <<<END
                    SELECT * FROM Lop_Hoc_Phan WHERE ID_MONHOC='{$id}';
                    END;
        $data = $this->getData($query);
        return count($data) == 0;
    }

    public function delete($id) {
        $query = <<<END
            DELETE FROM MonHoc WHERE ID='{$id}'
        END;
        $this->update($query);
    }
    public function get($search) {
        $secondCond = "";
        if ($search !== "") {
            $secondCond = "WHERE (ID = '{$search}' OR TEN like '%{$search}%')";
        }
        $query = <<<END
                    SELECT * FROM MonHoc {$secondCond};
                    END;
        return $this->getData($query);
    }

    public function getID() {
        $query = <<<END
                    SELECT ID FROM MonHoc;
                    END;
        return $this->getData($query);
    }

    public function replace($id, $name, $idN, $tc) {
        $data = $this->get($id);
        if (count($data) > 0) {
            $query =<<<UK
            UPDATE MonHoc SET TEN='{$name}', ID_NGANH='{$idN}', TIN_CHI={$tc} WHERE ID='{$id}'
            UK;
        }
        else {
            $query =<<<UK
            INSERT INTO MonHoc(ID, TEN, ID_NGANH, TIN_CHI) VALUES ('{$id}',n'{$name}', '{$idN}', '{$tc}')
            UK;
        }
        $this->update($query);
    }

}