<?php


class EventActivity extends Model
{
    public $table = 'events_activities';
    public $columns = [
        'id', 'title_en', 'title_ar', 'desc_en','desc_ar', 'image', 'display', 'date'
    ];

}