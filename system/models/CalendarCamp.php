<?php


class CalendarCamp extends Model
{
    public $table = 'calendar_camp';
    public $columns = [
        'id', 'camp_id', 'close_date', 'created_by', 'date',
        'price', 'paid', 'remain', 'client_name', 'client_mobile'
    ];

    public function getAll($aStart = 0, $aLimit = 0, $get)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON calendar_camp.camp_id = entities.id 
        ORDER BY camp_id ASC";

        $result = $this->con->query($sql);

        $camps = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($camps, $row);
            $x++;
        }
        return $camps;
    }

    public function getByDate($date)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON calendar_camp.camp_id = entities.id 
        WHERE close_date = '" . $date . "' 
        ORDER BY camp_id ASC";

        $result = $this->con->query($sql);

        $camps = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($camps, $row);
            $x++;
        }
        return $camps;
    }

    public function getByEntity($id)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON calendar_camp.camp_id = entities.id 
        WHERE camp_id = '" . $id . "'";

        $result = $this->con->query($sql);

        $camps = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($camps, $row);
            $x++;
        }
        return $camps;
    }
    
    public function getDatesByEntity($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE camp_id = " . $id;

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
            "` WHERE `" . $this->table . "`.`camp_id` = " . $entity_id;

        return $this->con->query($sql);
    }

    public function isExist($id, $date)
    {
        $sql = " SELECT * FROM `" . $this->table . "` WHERE close_date = '" . $date .
            "' AND camp_id = '" . $id .
            "' LIMIT 1";

        $result = $this->con->query($sql);
        return mysqli_fetch_assoc($result);
    }

    public function getByEntityBetweenDates($entity_id, $from, $to)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON calendar_camp.camp_id = entities.id 
        WHERE camp_id = '" . $entity_id . "' AND close_date BETWEEN '" . $from . "' AND '" . $to . "'";

        $result = $this->con->query($sql);

        $camps = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($camps, $row);
            $x++;
        }
        return $camps;
    }
}