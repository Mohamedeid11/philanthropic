<?php


class MediaCenter extends Model
{
    public $table = 'media_center';
    public $columns = [
        'id', 'title_en', 'title_ar', 'desc_en','desc_ar', 'image', 'display', 'date'
    ];
}