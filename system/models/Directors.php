<?php


class Directors extends Model
{
    public $table = 'directors';
    public $columns = [
        'id', 'name_ar', 'name_en', 'position_ar','position_en', 'image', 'display', 'date'
    ];

    public function getLimitOne() {
        $sql = " SELECT * FROM `" . $this->table . "` WHERE display = 1 ORDER BY `id` ASC LIMIT 1 ";

        $result = $this->con->query($sql);

        $row = mysqli_fetch_assoc($result) ;

        return $row;
    }

    public function getLimitsix() {
        $arr = array();
        $sql = " SELECT * FROM `" . $this->table . "` WHERE display = 1 ORDER BY `id` ASC LIMIT 6 ";

        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
            $x++;
        }
        return $arr;
    }

}