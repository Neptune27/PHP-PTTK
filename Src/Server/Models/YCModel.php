<?php
class YCModel extends Model
{
    public function canDelete($id) {
        return true;
    }

    public function delete($id) {
        $query = <<<END
            DELETE FROM YCMoThemSL WHERE ID_MON_HOC='{$id}'
        END;
        $this->update($query);
    }
    public function get($search) {
        $secondCond = "";
        if ($search !== "") {
            $secondCond = "WHERE (ID_MON_HOC like '%{$search}%')";
        }
        $query = <<<END
                    SELECT ID_MON_HOC, COUNT(ID_MON_HOC) AS SL FROM YCMoThemSL {$secondCond} GROUP BY ID_MON_HOC;
                    END;
        return $this->getData($query);
    }

    public function getCustom($mssv, $mmh) {

        $query = <<<END
                    SELECT ID_MON_HOC FROM YCMoThemSL WHERE MSSV='{$mssv}' AND ID_MON_HOC='{$mmh}';
                    END;
        return $this->getData($query);
    }


    public function getID() {
        $query = <<<END
                    SELECT ID FROM YCMoThemSL;
                    END;
        return $this->getData($query);
    }

    public function replace($id, $name) {
        $data = $this->getCustom($name, $id);
        if (count($data) == 0) {
            $query =<<<UK
            INSERT INTO YCMoThemSL(ID_MON_HOC, MSSV) 
            VALUES('{$id}', '{$name}')
            UK;
            $this->update($query);

        }

    }

}