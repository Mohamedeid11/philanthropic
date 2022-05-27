<?php

class Offer extends Model
{
    public $table = 'offers';
    public $columns = [
        'id', 'entity_id', 'discount', 'from_date', 'to_date', 'date'
    ];

    public function getAll($aStart = 0, $aLimit = 0, $get)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON offers.entity_id = entities.id 
        ORDER BY entity_id ASC";

        $result = $this->con->query($sql);

        $offers = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($offers, $row);
            $x++;
        }
        return $offers;
    }
}