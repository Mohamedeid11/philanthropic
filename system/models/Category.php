<?php

class Category extends Model
{
    public $table = 'categories';
    public $columns = [
        'id', 'name_ar', 'name_en', 'image', 'display', 'date'
    ];

    public function getActiveWithLang($lang) {
        $arr = array();
        $sql = " SELECT id, image, name_" . $lang . " AS name FROM `" . $this->table . "` WHERE display = 1";

        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
            $x++;
        }
        return $arr;
    }
}