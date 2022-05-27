<?php


class PaymentMethod extends Model
{
    public $table = 'payment_method';
    public $columns = [
        'id', 'title_en', 'title_ar', 'display'
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


}