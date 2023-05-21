<?php
class MonTienQuyetModel extends Model
{
    public function canDelete($id) {
        $query = <<<END
                    SELECT * FROM MonTienQuyet WHERE ID_MON_HOC_TRUOC='{$id}';
                    END;
        $data = $this->getData($query);
        return count($data) == 0;
    }

    public function delete($id) {
        $query = <<<END
            DELETE FROM MonTienQuyet WHERE ID_MON_HOC='{$id}'
        END;
        $this->update($query);
    }
    public function get($search) {
        $secondCond = "";
        if ($search !== "") {
            $secondCond = "WHERE (ID_MON_HOC = '{$search}')";
        }
        $query = <<<END
                    SELECT * FROM MonTienQuyet {$secondCond};
                    END;
        return $this->getData($query);
    }

    public function getID() {
        $query = <<<END
                    SELECT ID_MON_HOC AS ID FROM MonTienQuyet;
                    END;
        return $this->getData($query);
    }

    public function replace($id, $idT) {
        $data = $this->get($id);
        if (count($data) > 0) {
            $query =<<<UK
            UPDATE MonTienQuyet SET ID_MON_HOC_TRUOC='{$idT}' WHERE ID_MON_HOC='{$id}'
            UK;
        }
        else {
            $query =<<<UK
            INSERT INTO MonTienQuyet(ID_MON_HOC, ID_MON_HOC_TRUOC) VALUES ('{$id}','{$idT}')
            UK;
        }
        $this->update($query);
    }

}