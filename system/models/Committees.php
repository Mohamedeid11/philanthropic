<?php


class Committees extends Model
{
    public $table = 'committees';
    public $columns = [
        'id', 'name_ar', 'name_en', 'position_ar','position_en', 'title_en', 'title_ar', 'desc_en','desc_ar', 'image', 'display', 'date'
    ];

}