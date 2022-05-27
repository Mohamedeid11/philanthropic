<?php

class CalendarPool extends Model
{
    public $table = 'calendar_pool';
    public $columns = [
        'id', 'pool_id', 'close_date', 'close_time', 'created_by', 'date',
        'price', 'paid', 'remain', 'client_name', 'client_mobile'
    ];

    public function getAll($aStart = 0, $aLimit = 0, $get)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON calendar_pool.pool_id = entities.id 
        ORDER BY pool_id ASC";

        $result = $this->con->query($sql);

        $pools = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($pools, $row);
            $x++;
        }
        return $pools;
    }

    public function getByDate($date)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON calendar_pool.pool_id = entities.id 
        WHERE close_date = '" . $date . "' 
        ORDER BY pool_id ASC";

        $result = $this->con->query($sql);

        $pools = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($pools, $row);
            $x++;
        }
        return $pools;
    }

    public function getByEntity($id)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON calendar_pool.pool_id = entities.id 
        WHERE pool_id = '" . $id . "'";

        $result = $this->con->query($sql);

        $pools = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($pools, $row);
            $x++;
        }
        return $pools;
    }
    
    public function getDatesByEntity($id)
    {
        $sql = "SELECT close_date, close_time FROM " . $this->table . " WHERE pool_id = " . $id;

        $result = $this->con->query($sql);

        $dates = array();
        $arr = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            
            
            $arr[$row['close_date']][] = $row['close_time'];
            
            $x++;
        }
        foreach($arr as $key => $period) {
            if (count($arr[$key]) == 2) {
                $dates['closed'][] = $key;
            } else {
                $dates['half'][] = [
                    'date' => $key,
                    'lock' => $period[0]
                
                ];
            }
        }
        return $dates;
    }

    public function deleteEntityReservations($entity_id)
    {
        $sql = "DELETE FROM `" . $this->table .
            "` WHERE `" . $this->table . "`.`pool_id` = " . $entity_id;

        return $this->con->query($sql);
    }

    public function isExist($id, $date, $time)
    {
        $sql = " SELECT * FROM `" . $this->table . "` WHERE close_date = '" . $date .
            "' AND close_time = '" . $time .
            "' AND pool_id = '" . $id .
            "' LIMIT 1";

        $result = $this->con->query($sql);
        return mysqli_fetch_assoc($result);
    }

    public function getByEntityBetweenDates($entity_id, $from, $to)
    {
        $sql = "SELECT * FROM `entities` INNER JOIN `" . $this->table . "` 
        ON calendar_pool.pool_id = entities.id 
        WHERE pool_id = '" . $entity_id . "' AND close_date BETWEEN '" . $from . "' AND '" . $to . "'";

        $result = $this->con->query($sql);

        $pools = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($pools, $row);
            $x++;
        }
        return $pools;
    }
}