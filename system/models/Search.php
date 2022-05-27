<?php


class Search extends Model
{
    public $table = 'search';
    public $columns = [
        'id', 'name_ar', 'name_en'
    ];
    
    public function getWithLang($lang)
    {
        $arr = array();
        $sql = " SELECT id, name_" . $lang . " AS name FROM `" . $this->table . "`";

        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
            $x++;
        }
        return $arr;
    }
}