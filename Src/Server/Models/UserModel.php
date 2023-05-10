<?php
class UserModel extends Model
{
    public function getUser($username, $pass) {
        $query = "SELECT * FROM SinhVien WHERE MSSV='{$username}' AND PASSWORD='{$pass}'";
        return $this->getData($query);
    }

}