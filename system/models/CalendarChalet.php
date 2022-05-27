<?php

class CalendarChalet extends Model
{
    public $table = 'calendar_chalet';
    public $columns = [
        'id', 'chalet_id', 'close_date', 'created_by', 'date',
        'price', 'paid', 'remain', 'client_name', 'client_mobile'
    ];

    public function getAll($aStart = 0, $aLimit = 0, $get)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON calendar_chalet.chalet_id = entities.id 
        ORDER BY chalet_id ASC";

        $result = $this->con->query($sql);

        $chalets = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($chalets, $row);
            $x++;
        }
        return $chalets;
    }

    public function getByDate($date)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON calendar_chalet.chalet_id = entities.id 
        WHERE close_date = '" . $date . "' 
        ORDER BY chalet_id ASC";

        $result = $this->con->query($sql);

        $chalets = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($chalets, $row);
            $x++;
        }
        return $chalets;
    }

    public function getByEntity($id)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON calendar_chalet.chalet_id = entities.id 
        WHERE chalet_id = '" . $id . "'";

        $result = $this->con->query($sql);

        $chalets = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($chalets, $row);
            $x++;
        }
        return $chalets;
    }
    
    public function getDatesByEntity($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE chalet_id = " . $id;

        $result = $this->con->query($sql);

        $dates = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($dates, $row['close_date']);
            $x++;
        }
        return $dates;
    }

    public function deleteEntityReservations($entity_id)
    {
        $sql = "DELETE FROM `" . $this->table .
            "` WHERE `" . $this->table . "`.`chalet_id` = " . $entity_id;

        return $this->con->query($sql);
    }

    public function isExist($id, $date)
    {
        $sql = " SELECT * FROM `" . $this->table . "` WHERE close_date = '" . $date .
            "' AND chalet_id = '" . $id .
            "' LIMIT 1";

        $result = $this->con->query($sql);
        return mysqli_fetch_assoc($result);
    }

    public function getByEntityBetweenDates($entity_id, $from, $to)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON calendar_chalet.chalet_id = entities.id 
        WHERE chalet_id = '" . $entity_id . "' AND close_date BETWEEN '" . $from . "' AND '" . $to . "'";

        $result = $this->con->query($sql);

        $chalets = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($chalets, $row);
            $x++;
        }
        return $chalets;
    }
}