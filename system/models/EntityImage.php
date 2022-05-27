<?php


class EntityImage extends Model
{
    public $table = 'entities_images';
    public $columns = [
        'id', 'entity_id','image', 'type', 'date'
    ];

    public function getByEntity($entity_id)
    {
        $sql = " SELECT * FROM `" . $this->table . "` WHERE entity_id = '" . $entity_id . "'";

        $result = $this->con->query($sql);

        $images = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($images, $row);
            $x++;
        }
        return $images;
    }

    public function deleteEntityImages($entity_id)
    {
        $sql = "DELETE FROM `" . $this->table .
            "` WHERE `" . $this->table . "`.`entity_id` = " . $entity_id;

        return $this->con->query($sql);
    }
}