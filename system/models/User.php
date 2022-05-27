<?php

class User extends Model
{
    public $table = 'users';
    public $columns = [
        'id', 'username', 'password', 'email', 'mobile', 'image', 'role', 'status', 'date'
    ];

    public function getByName($name)
    {
        $sql = " SELECT * FROM `" . $this->table . "` WHERE username = '" . $name . "' LIMIT 1";

        $result = $this->con->query($sql);
        return mysqli_fetch_assoc($result);
    }

    public function getByMobile($mobile)
    {
        $sql = " SELECT * FROM `" . $this->table . "` WHERE mobile = '" . $mobile . "' LIMIT 1";

        $result = $this->con->query($sql);
        return mysqli_fetch_assoc($result);
    }

    public function getByEmail($email)
    {
        $sql = " SELECT * FROM `" . $this->table . "` WHERE email = '" . $email . "' LIMIT 1";

        $result = $this->con->query($sql);
        return mysqli_fetch_assoc($result);
    }

    public function getUsers()
    {
        $sql = " SELECT * FROM `" . $this->table . "` WHERE role = 'user'";

        $result = $this->con->query($sql);

        $users = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($users, $row);
            $x++;
        }
        return $users;
    }
}