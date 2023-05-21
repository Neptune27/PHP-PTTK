<?php
class KhoaModel extends Model
{
    public function canDelete($id) {
        $query = <<<END
                    SELECT * FROM Nganh WHERE ID_KHOA='{$id}';
                    END;
        $data = $this->getData($query);
        return count($data) == 0;
    }

    public function delete($id) {
        $query = <<<END
            DELETE FROM Khoa WHERE ID='{$id}'
        END;
        $this->update($query);
    }
    public function get($search) {
        $secondCond = "";
        if ($search !== "") {
            $secondCond = "WHERE (ID = '{$search}' OR TEN like '%{$search}%')";
        }
        $query = <<<END
                    SELECT * FROM Khoa {$secondCond};
                    END;
        return $this->getData($query);
    }

    public function getID() {
        $query = <<<END
                    SELECT ID FROM Khoa;
                    END;
        return $this->getData($query);
    }

    public function replace($id, $name, $t1t) {
        $data = $this->get($id);
        if (count($data) > 0) {
            $query =<<<UK
            UPDATE Khoa SET TEN='{$name}', TIEN_1_TIN='{$t1t}' WHERE ID='{$id}'
            UK;
        }
        else {
            $query =<<<UK
            INSERT INTO Khoa(ID, TEN, TIEN_1_TIN) VALUES ('{$id}','{$name}', '{$t1t}')
            UK;
        }
        $this->update($query);
    }

}