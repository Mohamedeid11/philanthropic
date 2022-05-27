<?php

class Magazine extends Model
{
    public $table = 'magazine';
    public $columns = [
        'id', 'title_en', 'title_ar' , 'image', 'display', 'date'
    ];

}