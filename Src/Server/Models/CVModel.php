<?php
class CVModel extends Model
{
    public function get($search) {
        $secondCond = "";
        if ($search !== "") {
            $secondCond = "WHERE (ID = '{$search}' OR TEN like '%{$search}%')";
        }
        $query = <<<END
                    SELECT * FROM ChucVuGV {$secondCond};
                    END;
        return $this->getData($query);
    }

    public function getID() {
        $query = <<<END
                    SELECT ID FROM ChucVuGV;
                    END;
        return $this->getData($query);
    }

}