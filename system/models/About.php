<?php


class About extends Model
{
    public $table = 'about';
    public $columns = [
        'id', 'title_en', 'title_ar', 'desc_en','desc_ar', 'display', 'date'
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