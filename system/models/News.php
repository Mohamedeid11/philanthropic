<?php


class News extends Model
{
    public $table = 'news';
    public $columns = [
        'id', 'title_en', 'title_ar', 'desc_en','desc_ar', 'image', 'display', 'date'
    ];

}