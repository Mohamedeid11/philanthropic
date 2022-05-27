<?php


class Donate extends Model
{
    public $table = 'donates';
    public $columns = [
        'id', 'title_ar', 'title_en',  'image', 'price' , 'display', 'date'
    ];

}