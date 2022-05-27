<?php


class Filter extends Model
{
    public $table = 'filter';
    public $columns = [
        'id', 'name_ar', 'name_en', 'type'
    ];

    public function getByType($type)
    {
        $arr = array();
        $sql = "SELECT * FROM `" . $this->table . "` where type = '" . $type . "'";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
            $x++;
        }
        return $arr;
    }

    public function getByTypeAPI($type, $lang)
    {
        $arr = array();
        $sql = "SELECT id, name_{$lang} as name FROM `" . $this->table . "` where type = '" . $type . "'";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
            $x++;
        }
        return $arr;
    }
}