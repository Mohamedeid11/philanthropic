<?php


class CalendarStadium extends Model
{
    public $table = 'calendar_stadium';
    public $columns = [
        'id', 'stadium_id', 'close_date', 'from_time', 'to_time', 'created_by',
        'date', 'price', 'paid', 'remain', 'client_name', 'client_mobile'
    ];

    public function getAll($aStart = 0, $aLimit = 0, $get)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON calendar_stadium.stadium_id = entities.id 
        ORDER BY stadium_id ASC";

        $result = $this->con->query($sql);

        $stadiums = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($stadiums, $row);
            $x++;
        }
        return $stadiums;
    }

    public function getByDate($date)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON calendar_stadium.stadium_id = entities.id 
        WHERE close_date = '" . $date . "' 
        ORDER BY stadium_id ASC";

        $result = $this->con->query($sql);

        $stadiums = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($stadiums, $row);
            $x++;
        }
        return $stadiums;
    }

    public function getByEntity($id)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON calendar_stadium.stadium_id = entities.id 
        WHERE stadium_id = '" . $id . "'";

        $result = $this->con->query($sql);

        $stadiums = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($stadiums, $row);
            $x++;
        }
        return $stadiums;
    }

    public function deleteEntityReservations($entity_id)
    {
        $sql = "DELETE FROM `" . $this->table .
            "` WHERE `" . $this->table . "`.`stadium_id` = " . $entity_id;

        return $this->con->query($sql);
    }

    public function getByEntityBetweenDates($entity_id, $from, $to)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON calendar_stadium.stadium_id = entities.id 
        WHERE stadium_id = '" . $entity_id . "' AND close_date BETWEEN '" . $from . "' AND '" . $to . "'";

        $result = $this->con->query($sql);

        $stadiums = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($stadiums, $row);
            $x++;
        }
        return $stadiums;
    }
}