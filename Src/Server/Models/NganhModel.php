<?php
class NganhModel extends Model
{
    public function canDelete($id) {
        $query = <<<END
                    SELECT * FROM MonHoc WHERE ID_NGANH='{$id}';
                    END;
        $data = $this->getData($query);
        return count($data) == 0;
    }

    public function delete($id) {
        $query = <<<END
            DELETE FROM Nganh WHERE ID='{$id}'
        END;
        $this->update($query);
    }
    public function get($search) {
        $secondCond = "";
        if ($search !== "") {
            $secondCond = "WHERE (ID = '{$search}' OR TEN like '%{$search}%')";
        }
        $query = <<<END
                    SELECT * FROM Nganh {$secondCond};
                    END;
        return $this->getData($query);
    }

    public function getID() {
        $query = <<<END
                    SELECT ID FROM Nganh;
                    END;
        return $this->getData($query);
    }

    public function replace($id, $name, $idK) {
        $data = $this->get($id);
        if (count($data) > 0) {
            $query =<<<UK
            UPDATE Nganh SET TEN='{$name}', ID_KHOA='{$idK}' WHERE ID='{$id}'
            UK;
        }
        else {
            $query =<<<UK
            INSERT INTO Nganh(ID, TEN, ID_KHOA) VALUES ('{$id}','{$name}', '{$idK}')
            UK;
        }
        $this->update($query);
    }
}