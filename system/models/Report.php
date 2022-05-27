<?php

class Report extends Model
{
    public $table = 'reports';
    public $columns = [
        'id', 'entity_id','client_id', 'comment', 'date'
    ];

    public function getByEntity($entity_id)
    {
        $sql = "SELECT * FROM `" . $this->table . "` WHERE entity_id = '" . $entity_id . "'";

        $result = $this->con->query($sql);

        $reports = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($reports, $row);
            $x++;
        }
        return $reports;
    }

    public function hasReport($client_id, $entity_id)
    {
        $sql = "SELECT * FROM `" . $this->table . "` WHERE client_id = '" . $client_id .
            "' AND entity_id = " . $entity_id . " LIMIT 1";

        $result = $this->con->query($sql);
        return mysqli_fetch_assoc($result);
    }

    public function deleteEntityReports($entity_id)
    {
        $sql = "DELETE FROM `" . $this->table .
            "` WHERE `" . $this->table . "`.`entity_id` = " . $entity_id;

        return $this->con->query($sql);
    }
}