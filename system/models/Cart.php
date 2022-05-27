<?php


class Cart extends Model
{
    public $table = 'cart';
    public $columns = [
        'id', 'client_id', 'donate_type_id', 'donate_id', 'price','status' , 'notes', 'date'
    ];

    public function NotConfirmed($client_id) {
        $arr = array();
        $sql = " SELECT * FROM `" . $this->table . "` WHERE status = 0 and client_id = '$client_id' ORDER BY `id` DESC ";

        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
            $x++;
        }
        return $arr;
    }

    public function CartsID($client_id) {
        $arr = array();
        $sql = " SELECT  `id` FROM `" . $this->table . "` WHERE status = 0 and client_id = '$client_id' ";

        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($arr, $row);
            $x++;
        }
        return $arr;
    }

    public function TotalPrice($client_id) {
        $total = 0 ;
        $cartObj =  new Cart();
        $cart_data  = $cartObj->NotConfirmed($client_id);
        foreach ($cart_data as $cart){
            $cart_id = $cart['id'];
            $donate_id = $cart['donate_id'];
            $total += $cart['price'];
        }

        return $total ;
    }

}