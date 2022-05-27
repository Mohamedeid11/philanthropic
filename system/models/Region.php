<?php


class Region extends Model
{
    public $table = 'regions';
    public $columns = [
        'id', 'name_ar', 'name_en', 'date'
    ];

    public function getAllAPI($lang)
    {
        $sql = "SELECT id, name_{$lang} as name FROM $this->table";
        $result = $this->con->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}