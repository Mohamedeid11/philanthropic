<?php


abstract class Model
{
    public $table;
    public $con;
    public $columns = [];

    public function __construct()
    {
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            $this->con = new mysqli(
                "localhost", "root", "", "bhphilanthropic_system"
            );
        } else {
            $this->con = new mysqli(
                "localhost","bhphilanthropic_system","2zeF^K@3l7&@","bhphilanthropic_system"
            );
        }
        mysqli_query($this->con,"set character_set_server='utf8'");
        mysqli_query($this->con,"set names 'utf8'");
        mysqli_query($this->con, "SET sql_mode=''");

        // Check connection
        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }
    }


    public function create(array $data)
    {
        $columns = '';
        $values = '';
        foreach ($this->columns as $column) {
            $columns .= "`" . $column . "`, ";
            if (isset($data[$column])) {
                $values .= "'" . htmlspecialchars($data[$column]) . "', ";
            } else {
                $values .= "NULL , ";
            }
        }
        $columns = rtrim($columns, ', ');
        $values = rtrim($values, ', ');


        $sql = "INSERT INTO `" . $this->table . "` (" . $columns . ") VALUES (" . $values . ")";

        if ($this->con->query($sql) === TRUE) {
            return $this->con->insert_id;
        } else {
            echo get_error("Error: " . $this->con->error);
        }
    }

    public function update(array $data)
    {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "`" . $key . "` = '" . htmlspecialchars($value) . "', ";
        }
        $fields = rtrim($fields, ', ');


        $sql = "UPDATE `" . $this->table . "` SET $fields WHERE `" .
            $this->table . "`.`id` = " . $data['id'];

        if ($this->con->query($sql) === TRUE) {
            return true;
        } else {
            echo get_error("Error: " . $this->con->error);
            return false;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `" . $this->table .
            "` WHERE `" . $this->table . "`.`id` = " . $id;

        return $this->con->query($sql);
    }

    public function count($get)
    {
        $sql = " SELECT id FROM `" . $this->table . "`";

        $result = $this->con->query($sql);

        return $result->num_rows;
    }

    public function countAll() {

        $sql = " SELECT * FROM `" . $this->table . "` ";

        $result = $this->con->query($sql);

        return $result->num_rows;
    }

    public function getAll($aStart = 0, $aLimit = 0, $get = []) {
        $arr = array();
        $sql = " SELECT * FROM `" . $this->table . "` ORDER BY `id` DESC ";

        $sql .= $aLimit > 0 ? "LIMIT {$aStart},{$aLimit}" : "";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
            $x++;
        }
        return $arr;
    }

    public function show() {
        $arr = array();
        $sql = " SELECT * FROM `" . $this->table . "` ORDER BY `id` DESC ";

        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
            $x++;
        }
        return $arr;
    }

    public function getActive() {
        $arr = array();
        $sql = " SELECT * FROM `" . $this->table . "` WHERE display = 1 ORDER BY `id` DESC ";

        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
            $x++;
        }
        return $arr;
    }

    public function getById($id)
    {
        $sql = " SELECT * FROM `" . $this->table . "` WHERE id = '$id'  ";

        $result = $this->con->query($sql);
        return mysqli_fetch_assoc($result);
    }


}