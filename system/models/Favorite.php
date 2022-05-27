<?php


class Favorite extends Model
{
    public $table = 'favorite';
    public $columns = [
        'id', 'client_id', 'entity_id'
    ];

    public function getByClientEntity($client_id, $entity_id)
    {
        $sql = "SELECT * FROM `" . $this->table . "` WHERE `client_id` = '" . $client_id .
            "' AND `entity_id` = " . $entity_id . " LIMIT 1";

        $result = $this->con->query($sql);
        return mysqli_fetch_assoc($result);
    }

    public function getMyFavourite($client_id, $lang = 'en')
    {
        $sql = " SELECT * FROM `" . $this->table . "` WHERE `client_id` = " . $client_id . " ORDER BY `id` DESC ";
        $result = $this->con->query($sql);
        $ids = "";
        while ($row = mysqli_fetch_assoc($result)) {
            $ids .= "'" . $row['entity_id'] . "', ";
        }
        $ids = rtrim($ids, ", ");
        if ($ids == "") {
            return [];
        } else {
            $sql = " SELECT *, name_" . $lang . " AS name, desc_" . $lang . " AS description, address_" . $lang . " AS address FROM `entities` WHERE display = 1 AND id IN (" . $ids . ") ORDER BY `id` DESC ";
        }
        $entities = array();
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            include_once 'Review.php';
            include_once 'EntityImage.php';
            $reviewObj = new Review();
            $row['rate'] = $reviewObj->getEntityTotalReviewCount($row['id']);
            $imagesObj = new EntityImage();
            $row['images'] = $imagesObj->getByEntity($row['id']);
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }
}