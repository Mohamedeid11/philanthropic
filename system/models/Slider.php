<?php


class Slider extends Model
{
    public $table = 'slider';
    public $columns = [
        'id', 'image', 'display', 'date'
    ];

    public function getActiveWithLang($lang) {
        $arr = array();
        $sql = " SELECT id, image, title_" . $lang . " AS title FROM `" . $this->table . "` WHERE display = 1";

        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
            $x++;
        }
        return $arr;
    }
}