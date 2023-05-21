<?php
class ThoiGianMonHocModel extends Model
{
    public function canDelete($id) {
        return 1;
    }

    public function deleteCustom($id, $nam, $hk, $tbd, $l) {
        $secondCond = "";
        $query = <<<END
                    DELETE FROM ThoiGianMonHoc WHERE ID_DSMH='{$id}' AND NAM='{$nam}' AND HK='{$hk}' AND TIET_BAT_DAU='{$tbd}' AND LOP='{$l}';
                    END;
        return $this->update($query);
    }
    public function get($search) {
        $secondCond = "";
        if ($search !== "") {
            $secondCond = "WHERE (ID_DSMH = '{$search}')";
        }
        $query = <<<END
                    SELECT * FROM ThoiGianMonHoc {$secondCond} ORDER BY NAM DESC, HK DESC;
                    END;
        return $this->getData($query);
    }

    public function getCustom($id, $nam, $hk, $tbd, $l) {
        $secondCond = "";
        $query = <<<END
                    SELECT * FROM ThoiGianMonHoc WHERE ID_DSMH='{$id}' AND NAM='{$nam}' AND HK='{$hk}' AND TIET_BAT_DAU='{$tbd}' AND LOP='{$l}';
                    END;
        return $this->getData($query);
    }

    public function getID() {
        $query = <<<END
                    SELECT ID_DSMH as ID FROM ThoiGianMonHoc;
                    END;
        return $this->getData($query);
    }

    public function replace($id, $tbd, $tkt, $lop, $tuan, $idGV, $hk, $nam, $thu) {
        $data = $this->getCustom($id, $nam, $hk, $tbd, $lop);
        if (count($data) > 0) {
            $query =<<<UK
            UPDATE ThoiGianMonHoc SET TIET_KET_THUC='{$tkt}', TUANHOC='{$tuan}', ID_GVGD='{$idGV}', THU='{$thu}' 
                  WHERE ID_DSMH='{$id}' AND LOP='{$lop}' AND TIET_BAT_DAU='{$tbd}' AND HK='{$hk}' AND NAM='{$nam}'
            UK;
        }
        else {
            $query =<<<UK
            INSERT INTO ThoiGianMonHoc(ID_DSMH, TIET_BAT_DAU, LOP, TIET_KET_THUC, TUANHOC, ID_GVGD, HK, NAM, THU) 
            VALUES ('{$id}','{$tbd}', '{$lop}' , '{$tkt}',{$tuan}, '{$idGV}' , '{$hk}', '{$nam}','{$thu}')
            UK;
        }
        $this->update($query);
    }

}