<?php


class Orders extends Model
{
    public $table = 'orders';
    public $columns = [
        'id', 'donate_type', 'client_id', 'cart_id' , 'payment_method' , 'total_price', 'date'
    ];

}