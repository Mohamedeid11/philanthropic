<?php

class Client extends Model
{
    public $table = 'clients';
    public $columns = [
        'id', 'name', 'mobile', 'password', 'verified', 'email',
    ];

    public function getActiveByID($type_id) {
        $arr = array();
        $sql = " SELECT * FROM `" . $this->table . "` WHERE id = '$type_id' ";

        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
            $x++;
        }
        return $arr;
    }

    public function getByMobile($mobile)
    {
        $sql = " SELECT * FROM `" . $this->table . "` WHERE mobile = '" . $mobile . "' LIMIT 1";

        $result = $this->con->query($sql);
        return mysqli_fetch_assoc($result);
    }

    public function getByEmail($email)
    {
        $sql = " SELECT * FROM `" . $this->table . "` WHERE email = '" . $email . "' LIMIT 1";

        $result = $this->con->query($sql);
        return mysqli_fetch_assoc($result);
    }

    public function getDeviceTokens() {
        $entities = array();
        $sql = " SELECT * FROM `" . $this->table . "` WHERE `fcm` != '' ORDER BY `id` DESC ";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($entities, $row['fcm']);
            $x++;
        }
        return $entities;
    }

    public function getVerified() {
        $arr = array();
        $sql = " SELECT * FROM `" . $this->table . "` WHERE verified = 1 ORDER BY `id` DESC ";

        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
            $x++;
        }
        return $arr;
    }
}