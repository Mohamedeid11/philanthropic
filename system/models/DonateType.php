<?php


class DonateType extends Model
{
    public $table = 'donate_type';
    public $columns = [
        'id', 'name', 'display'
    ];

    public function getActiveByID($type_id) {
        $arr = array();
        $sql = " SELECT * FROM `" . $this->table . "` WHERE id = '$type_id' AND display = 1 ";

        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
            $x++;
        }
        return $arr;
    }

}