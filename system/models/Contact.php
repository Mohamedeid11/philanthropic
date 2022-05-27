<?php


class Contact extends Model
{
    public $table = 'contact';
    public $columns = [
        'id', 'address_en','address_ar', 'email', 'phone', 'lat_loca', 'long_loca'
    ];

    public function  getEmail() {
        $arr = array();
        $sql = " SELECT email FROM `" . $this->table . "` WHERE id = 1";

        $result = $this->con->query($sql);

        $row = mysqli_fetch_array($result);
        $email = $row['email'];
        return $email;
    }

    public function getData(){

        $sql = " SELECT * FROM `" . $this->table . "` WHERE id = 1 ";

        $result = $this->con->query($sql);
        return mysqli_fetch_assoc($result);
    }

}