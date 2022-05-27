<?php


class Notification extends Model
{
    public $table = 'notifications';
    public $columns = [
        'id', 'name_ar','name_en', 'category_id', 'entity_id', 'link', 'date'
    ];

    public function getActive($lang = 'en') {
        $notifications = array();
        $sql = " SELECT *, name_" . $lang . " AS name FROM `" . $this->table . "` ORDER BY `id` DESC ";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $row['is_clickable'] = $row['entity_id'] ? 1 : 0;
            array_push($notifications, $row);
            $x++;
        }
        return $notifications;
    }
}