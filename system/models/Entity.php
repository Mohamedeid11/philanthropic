<?php

class Entity extends Model
{
    public $table = 'entities';
    public $columns = [
        'id', 'user_id', 'type', 'name_ar', 'name_en', 'desc_ar', 'desc_en', 'code', 'price',
        'check_in_am', 'check_out_am', 'check_in_pm', 'check_out_pm', 'address_ar',
        'address_en', 'lat_loca', 'long_loca', 'space', 'views', 'display', 'date',
        'price_weekend', 'discount', 'family', 'mobile', 'whatsapp', 'weekend_discount',
        'condition_rules_ar', 'condition_rules_en', 'check_availability', 'region_id', 'capacitance',
        'pool', 'amenities', 'bedroom', 'countBedrooms', 'kitchenAmenities'
    ];

    public function getPools($aStart = 0, $aLimit = 0, $get) {
        $entities = array();
        $sql = " SELECT * FROM `" . $this->table . "` WHERE `type` = 1 ORDER BY `id` DESC ";
        $sql .= $aLimit > 0 ? "LIMIT {$aStart},{$aLimit}" : "";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getChalets($aStart = 0, $aLimit = 0, $get) {
        $entities = array();
        $sql = " SELECT * FROM `" . $this->table . "` WHERE `type` = 2 ORDER BY `id` DESC ";
        $sql .= $aLimit > 0 ? "LIMIT {$aStart},{$aLimit}" : "";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getCamps($aStart = 0, $aLimit = 0, $get) {
        $entities = array();
        $sql = " SELECT * FROM `" . $this->table . "` WHERE `type` = 3 ORDER BY `id` DESC ";
        $sql .= $aLimit > 0 ? "LIMIT {$aStart},{$aLimit}" : "";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getStadiums($aStart = 0, $aLimit = 0, $get) {
        $entities = array();
        $sql = " SELECT * FROM `" . $this->table . "` WHERE `type` = 4 ORDER BY `id` DESC ";
        $sql .= $aLimit > 0 ? "LIMIT {$aStart},{$aLimit}" : "";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getActiveEntity($type, $lang = 'en', $client_id = 0) {
        $entities = array();
        $sql = " SELECT *, name_" . $lang . " AS name, desc_" . $lang . " AS description, address_" . $lang . " AS address, condition_rules_" . $lang . " AS condition_rules FROM `" . $this->table . "` WHERE `type` = " . $type . " AND display = 1 ORDER BY `id` DESC ";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            include_once 'Review.php';
            include_once 'Favorite.php';
            $reviewObj = new Review();
            $favoriteObj = new Favorite();
            $row['rate'] = $reviewObj->getEntityTotalReviewCount($row['id']);
            $imagesObj = new EntityImage();
            if ($client_id > 0) {
                $row['isFavorite'] = $favoriteObj->getByClientEntity($client_id, $row['id']) ? 1 : 0;
            } else {
                $row['isFavorite'] = 0;
            }
            $row['price'] = (string) ((float) $row['price']);
            $row['price_weekend'] = (string) ((float) $row['price_weekend']);
            if ($lang == 'ar') {
                $row['check_in_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_am']);
                $row['check_out_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_am']);
                $row['check_in_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_pm']);
                $row['check_out_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_pm']);
            }
            $row['images'] = $imagesObj->getByEntity($row['id']);
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getMostViewedEntity($type, $lang = 'en', $client_id = 0) {
        $entities = array();
        $sql = " SELECT *, name_" . $lang . " AS name, desc_" . $lang . " AS description, address_" . $lang . " AS address, condition_rules_" . $lang . " AS condition_rules FROM `" . $this->table . "` WHERE `type` = " . $type . " AND display = 1 ORDER BY `views` DESC ";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            include_once 'Review.php';
            include_once 'Favorite.php';
            $reviewObj = new Review();
            $favoriteObj = new Favorite();
            $row['rate'] = $reviewObj->getEntityTotalReviewCount($row['id']);
            if ($client_id > 0) {
                $row['isFavorite'] = $favoriteObj->getByClientEntity($client_id, $row['id']) ? 1 : 0;
            } else {
                $row['isFavorite'] = 0;
            }
            $imagesObj = new EntityImage();
            $row['price'] = (string) ((float) $row['price']);
            $row['price_weekend'] = (string) ((float) $row['price_weekend']);
            if ($lang == 'ar') {
                $row['check_in_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_am']);
                $row['check_out_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_am']);
                $row['check_in_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_pm']);
                $row['check_out_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_pm']);
            }
            $row['images'] = $imagesObj->getByEntity($row['id']);
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getMostReviewedEntity($type, $lang = 'en', $client_id = 0) {
        $entities = array();
        $sql = "SELECT id , entity_id ,AVG(rate) as totalRate from reviews GROUP BY entity_id ORDER BY totalRate DESC";
        $result = $this->con->query($sql);
        $x = 1;
        $ids = "";
        while ($row = mysqli_fetch_assoc($result)) {
            $ids .= "'" . $row['entity_id'] . "', ";
            $imagesObj = new EntityImage();
            $entity = $this->getById($row['entity_id'], $lang);
            if ($entity && $entity['type'] == $type) {
                $entity['price'] = (string) ((float) $entity['price']);
                $entity['price_weekend'] = (string) ((float) $entity['price_weekend']);
                if ($lang == 'ar') {
                    $row['check_in_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_am']);
                    $row['check_out_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_am']);
                    $row['check_in_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_pm']);
                    $row['check_out_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_pm']);
                }
                $entity['images'] = $imagesObj->getByEntity($row['entity_id']);
                array_push($entities, $entity);
                $x++;
            }
        }
        $ids = rtrim($ids, ", ");
        $sql = " SELECT *, name_" . $lang . " AS name, desc_" . $lang . " AS description, address_" . $lang . " AS address, condition_rules_" . $lang . " AS condition_rules FROM `" . $this->table . "` WHERE `type` = " . $type . " AND display = 1 AND id NOT IN (" . $ids . ") ORDER BY `id` DESC ";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            include_once 'Review.php';
            include_once 'Favorite.php';
            $reviewObj = new Review();
            $favoriteObj = new Favorite();
            $row['rate'] = $reviewObj->getEntityTotalReviewCount($row['id']);
            if ($client_id > 0) {
                $row['isFavorite'] = $favoriteObj->getByClientEntity($client_id, $row['id']) ? 1 : 0;
            } else {
                $row['isFavorite'] = 0;
            }
            $imagesObj = new EntityImage();
            $row['price'] = (string) ((float) $row['price']);
            $row['price_weekend'] = (string) ((float) $row['price_weekend']);
            if ($lang == 'ar') {
                $row['check_in_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_am']);
                $row['check_out_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_am']);
                $row['check_in_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_pm']);
                $row['check_out_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_pm']);
            }
            $row['images'] = $imagesObj->getByEntity($row['id']);
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getPoolsByDate($date, $lang = 'en', $client_id = 0) {
        $entities = array();
        $sql = "SELECT id , pool_id ,COUNT(id) as count from calendar_pool WHERE close_date = '" . $date . "' GROUP BY pool_id";
        $result = $this->con->query($sql);
        $ids = "";
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['count'] == 2) {
                $ids .= "'" . $row['pool_id'] . "', ";
            }
        }
        $ids = rtrim($ids, ", ");
        if ($ids == "") {
            $sql = " SELECT *, name_" . $lang . " AS name, desc_" . $lang . " AS description, address_" . $lang . " AS address, condition_rules_" . $lang . " AS condition_rules FROM `" . $this->table . "` WHERE `type` = 1 AND display = 1 ORDER BY `id` DESC ";
        } else {
            $sql = " SELECT *, name_" . $lang . " AS name, desc_" . $lang . " AS description, address_" . $lang . " AS address, condition_rules_" . $lang . " AS condition_rules FROM `" . $this->table . "` WHERE `type` = 1 AND display = 1 AND id NOT IN (" . $ids . ") ORDER BY `id` DESC ";
        }
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            include_once 'Review.php';
            include_once 'Favorite.php';
            $reviewObj = new Review();
            $favoriteObj = new Favorite();
            $row['rate'] = $reviewObj->getEntityTotalReviewCount($row['id']);
            if ($client_id > 0) {
                $row['isFavorite'] = $favoriteObj->getByClientEntity($client_id, $row['id']) ? 1 : 0;
            } else {
                $row['isFavorite'] = 0;
            }
            $imagesObj = new EntityImage();
            $row['price'] = (string) ((float) $row['price']);
            $row['price_weekend'] = (string) ((float) $row['price_weekend']);
            if ($lang == 'ar') {
                $row['check_in_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_am']);
                $row['check_out_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_am']);
                $row['check_in_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_pm']);
                $row['check_out_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_pm']);
            }
            $row['images'] = $imagesObj->getByEntity($row['id']);
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getChaletsByDate($date, $lang = 'en', $client_id = 0) {
        $entities = array();
        $sql = "SELECT id , chalet_id from calendar_chalet WHERE close_date = '" . $date . "'";
        $result = $this->con->query($sql);
        $ids = "";
        while ($row = mysqli_fetch_assoc($result)) {
            $ids .= "'" . $row['chalet_id'] . "', ";
        }
        $ids = rtrim($ids, ", ");
        if ($ids == "") {
            $sql = " SELECT *, name_" . $lang . " AS name, desc_" . $lang . " AS description, address_" . $lang . " AS address, condition_rules_" . $lang . " AS condition_rules FROM `" . $this->table . "` WHERE `type` = 2 AND display = 1 ORDER BY `id` DESC ";
        } else {
            $sql = " SELECT *, name_" . $lang . " AS name, desc_" . $lang . " AS description, address_" . $lang . " AS address, condition_rules_" . $lang . " AS condition_rules FROM `" . $this->table . "` WHERE `type` = 2 AND display = 1 AND id NOT IN (" . $ids . ") ORDER BY `id` DESC ";
        }
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            include_once 'Review.php';
            include_once 'Favorite.php';
            $reviewObj = new Review();
            $favoriteObj = new Favorite();
            $row['rate'] = $reviewObj->getEntityTotalReviewCount($row['id']);
            if ($client_id > 0) {
                $row['isFavorite'] = $favoriteObj->getByClientEntity($client_id, $row['id']) ? 1 : 0;
            } else {
                $row['isFavorite'] = 0;
            }
            $imagesObj = new EntityImage();
            $row['price'] = (string) ((float) $row['price']);
            $row['price_weekend'] = (string) ((float) $row['price_weekend']);
            if ($lang == 'ar') {
                $row['check_in_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_am']);
                $row['check_out_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_am']);
                $row['check_in_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_pm']);
                $row['check_out_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_pm']);
            }
            $row['images'] = $imagesObj->getByEntity($row['id']);
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getCampsByDate($date, $lang = 'en', $client_id = 0) {
        $entities = array();
        $sql = "SELECT id , camp_id from calendar_camp WHERE close_date = '" . $date . "'";
        $result = $this->con->query($sql);
        $ids = "";
        while ($row = mysqli_fetch_assoc($result)) {
            $ids .= "'" . $row['camp_id'] . "', ";
        }
        $ids = rtrim($ids, ", ");
        if ($ids == "") {
            $sql = " SELECT *, name_" . $lang . " AS name, desc_" . $lang . " AS description, address_" . $lang . " AS address, condition_rules_" . $lang . " AS condition_rules FROM `" . $this->table . "` WHERE `type` = 3 AND display = 1 ORDER BY `id` DESC ";
        } else {
            $sql = " SELECT *, name_" . $lang . " AS name, desc_" . $lang . " AS description, address_" . $lang . " AS address, condition_rules_" . $lang . " AS condition_rules FROM `" . $this->table . "` WHERE `type` = 3 AND display = 1 AND id NOT IN (" . $ids . ") ORDER BY `id` DESC ";
        }
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            include_once 'Review.php';
            include_once 'Favorite.php';
            $reviewObj = new Review();
            $favoriteObj = new Favorite();
            $row['rate'] = $reviewObj->getEntityTotalReviewCount($row['id']);
            if ($client_id > 0) {
                $row['isFavorite'] = $favoriteObj->getByClientEntity($client_id, $row['id']) ? 1 : 0;
            } else {
                $row['isFavorite'] = 0;
            }
            $imagesObj = new EntityImage();
            $row['price'] = (string) ((float) $row['price']);
            $row['price_weekend'] = (string) ((float) $row['price_weekend']);
            if ($lang == 'ar') {
                $row['check_in_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_am']);
                $row['check_out_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_am']);
                $row['check_in_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_pm']);
                $row['check_out_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_pm']);
            }
            $row['images'] = $imagesObj->getByEntity($row['id']);
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getMostPriceEntity($type, $lang = 'en', $client_id = 0) {
        $entities = array();
        $sql = " SELECT *, name_" . $lang . " AS name, desc_" . $lang . " AS description, address_" . $lang . " AS address, condition_rules_" . $lang . " AS condition_rules FROM `" . $this->table . "` WHERE `type` = " . $type . " AND display = 1 ORDER BY `price` DESC ";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            include_once 'Review.php';
            include_once 'Favorite.php';
            $reviewObj = new Review();
            $favoriteObj = new Favorite();
            $row['rate'] = $reviewObj->getEntityTotalReviewCount($row['id']);
            if ($client_id > 0) {
                $row['isFavorite'] = $favoriteObj->getByClientEntity($client_id, $row['id']) ? 1 : 0;
            } else {
                $row['isFavorite'] = 0;
            }
            $imagesObj = new EntityImage();
            $row['price'] = (string) ((float) $row['price']);
            $row['price_weekend'] = (string) ((float) $row['price_weekend']);
            if ($lang == 'ar') {
                $row['check_in_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_am']);
                $row['check_out_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_am']);
                $row['check_in_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_pm']);
                $row['check_out_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_pm']);
            }
            $row['images'] = $imagesObj->getByEntity($row['id']);
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getLeastPriceEntity($type, $lang = 'en', $client_id = 0) {
        $entities = array();
        $sql = " SELECT *, name_" . $lang . " AS name, desc_" . $lang . " AS description, address_" . $lang . " AS address, condition_rules_" . $lang . " AS condition_rules FROM `" . $this->table . "` WHERE `type` = " . $type . " AND display = 1 ORDER BY `price` ASC ";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            include_once 'Review.php';
            include_once 'Favorite.php';
            $reviewObj = new Review();
            $favoriteObj = new Favorite();
            $row['rate'] = $reviewObj->getEntityTotalReviewCount($row['id']);
            if ($client_id > 0) {
                $row['isFavorite'] = $favoriteObj->getByClientEntity($client_id, $row['id']) ? 1 : 0;
            } else {
                $row['isFavorite'] = 0;
            }
            $imagesObj = new EntityImage();
            $row['price'] = (string) ((float) $row['price']);
            $row['price_weekend'] = (string) ((float) $row['price_weekend']);
            if ($lang == 'ar') {
                $row['check_in_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_am']);
                $row['check_out_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_am']);
                $row['check_in_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_pm']);
                $row['check_out_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_pm']);
            }
            $row['images'] = $imagesObj->getByEntity($row['id']);
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getClosestEntity($type, $lat, $long, $lang = 'en', $client_id = 0) {
        $entities = array();
        $sql = " SELECT *, name_" . $lang . " AS name, desc_" . $lang . " AS description, address_" . $lang . " AS address, condition_rules_" . $lang . " AS condition_rules FROM `" . $this->table . "` WHERE `type` = " . $type . " AND display = 1";
        $result = $this->con->query($sql);
        $x = 1;
        $distance = [];
        while ($row = mysqli_fetch_assoc($result)) {
            include_once 'Review.php';
            include_once 'Favorite.php';
            $reviewObj = new Review();
            $favoriteObj = new Favorite();
            $row['rate'] = $reviewObj->getEntityTotalReviewCount($row['id']);
            if ($client_id > 0) {
                $row['isFavorite'] = $favoriteObj->getByClientEntity($client_id, $row['id']) ? 1 : 0;
            } else {
                $row['isFavorite'] = 0;
            }
            $imagesObj = new EntityImage();
            $row['price'] = (string) ((float) $row['price']);
            $row['price_weekend'] = (string) ((float) $row['price_weekend']);
            if ($lang == 'ar') {
                $row['check_in_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_am']);
                $row['check_out_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_am']);
                $row['check_in_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_pm']);
                $row['check_out_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_pm']);
            }
            $row['images'] = $imagesObj->getByEntity($row['id']);
            array_push($entities, $row);
            $disLat = pow(((float) $row['lat_loca'] - (float) $lat), 2);
            $disLong = pow(((float) $row['long_loca'] - (float) $long), 2);
            $distance[] = sqrt(($disLat + $disLong));
            $x++;
        }
        asort($distance);
        return [
            'entities' => $entities,
            'distance' => $distance,
        ];
    }

    public function search($search, $lang = 'en', $client_id = 0)
    {
        $entities = array();
        $sql = " SELECT *, name_" . $lang . " AS name, desc_" . $lang . " AS description, address_" . $lang . " AS address, condition_rules_" . $lang . " AS condition_rules FROM `" . $this->table . "` WHERE display = 1 AND (name_ar LIKE '%" . $search . "%' OR name_en LIKE '%" . $search . "%')";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            include_once 'Review.php';
            include_once 'Favorite.php';
            $reviewObj = new Review();
            $favoriteObj = new Favorite();
            $row['rate'] = $reviewObj->getEntityTotalReviewCount($row['id']);
            if ($client_id > 0) {
                $row['isFavorite'] = $favoriteObj->getByClientEntity($client_id, $row['id']) ? 1 : 0;
            } else {
                $row['isFavorite'] = 0;
            }
            $imagesObj = new EntityImage();
            $row['price'] = (string) ((float) $row['price']);
            $row['price_weekend'] = (string) ((float) $row['price_weekend']);
            if ($lang == 'ar') {
                $row['check_in_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_am']);
                $row['check_out_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_am']);
                $row['check_in_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_pm']);
                $row['check_out_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_pm']);
            }
            $row['images'] = $imagesObj->getByEntity($row['id']);
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getEntityById($id, $lang = 'en', $client_id = 0)
    {
        $sql = " SELECT *, name_" . $lang . " AS name, desc_" . $lang . " AS description, address_" . $lang . " AS address, condition_rules_" . $lang . " AS condition_rules FROM `" . $this->table . "` WHERE id = " . $id . " LIMIT 1";

        $result = $this->con->query($sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            include_once 'Review.php';
            include_once 'Favorite.php';
            $reviewObj = new Review();
            $favoriteObj = new Favorite();
            $row['rate'] = $reviewObj->getEntityTotalReviewCount($row['id']);
            if ($client_id > 0) {
                $row['isFavorite'] = $favoriteObj->getByClientEntity($client_id, $row['id']) ? 1 : 0;
            } else {
                $row['isFavorite'] = 0;
            }
            $imagesObj = new EntityImage();
            $row['price'] = (string) ((float) $row['price']);
            $row['price_weekend'] = (string) ((float) $row['price_weekend']);
            if ($lang == 'ar') {
                $row['check_in_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_am']);
                $row['check_out_am'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_am']);
                $row['check_in_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_in_pm']);
                $row['check_out_pm'] = str_replace(['am', 'pm'], ['صباحا', 'مساء'], $row['check_out_pm']);
            }
            $row['images'] = $imagesObj->getByEntity($row['id']);
            $featuresObj = new Feature();
            $row['features'] = $featuresObj->getByEntity($row['id'], $lang, $row['type']);
            if ($row['type'] == 4) {
                $row['payment'] = $featuresObj->getByType('payment', $row['id'], $lang);
                $row['size'] = $featuresObj->getByType('size', $row['id'], $lang);
                $row['period'] = $featuresObj->getByType('period', $row['id'], $lang);
            }
        }
        $this->update([
            'id' => $row['id'],
            'views' => $row['views'] + 1
        ]);
        return $row;
    }

    public function getMyPools($aStart = 0, $aLimit = 0, $get) {
        $entities = array();
        $sql = " SELECT * FROM `" . $this->table . "` WHERE `type` = 1 AND user_id = '" . $_SESSION['user_id'] . "' ORDER BY `id` DESC ";
        $sql .= $aLimit > 0 ? "LIMIT {$aStart},{$aLimit}" : "";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getMyChalets($aStart = 0, $aLimit = 0, $get) {
        $entities = array();
        $sql = " SELECT * FROM `" . $this->table . "` WHERE `type` = 2 AND user_id = '" . $_SESSION['user_id'] . "' ORDER BY `id` DESC ";
        $sql .= $aLimit > 0 ? "LIMIT {$aStart},{$aLimit}" : "";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getMyCamps($aStart = 0, $aLimit = 0, $get) {
        $entities = array();
        $sql = " SELECT * FROM `" . $this->table . "` WHERE `type` = 3 AND user_id = '" . $_SESSION['user_id'] . "' ORDER BY `id` DESC ";
        $sql .= $aLimit > 0 ? "LIMIT {$aStart},{$aLimit}" : "";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getMyStadiums($aStart = 0, $aLimit = 0, $get) {
        $entities = array();
        $sql = " SELECT * FROM `" . $this->table . "` WHERE `type` = 4 AND user_id = '" . $_SESSION['user_id'] . "' ORDER BY `id` DESC ";
        $sql .= $aLimit > 0 ? "LIMIT {$aStart},{$aLimit}" : "";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($entities, $row);
            $x++;
        }
        return $entities;
    }

    public function getById($id, $lang = 'en')
    {
        $sql = " SELECT *, name_" . $lang . " AS name, desc_" . $lang . " AS description, address_" . $lang . " AS address FROM `" . $this->table . "` WHERE id = " . $id . " LIMIT 1";

        $result = $this->con->query($sql);
        return mysqli_fetch_assoc($result);
    }

    public function filter($arr, $lang)
    {
        $sql = "SELECT *, name_$lang AS name, desc_$lang AS description, address_$lang AS address, 
            condition_rules_$lang AS condition_rules";
        $sql .= " FROM $this->table WHERE display = 1
            AND price > {$arr['minPrice']} AND price < {$arr['maxPrice']}";
        if (!empty($arr['region'])) {
            $sql .= " AND region_id in ({$arr['region']})";
        }
        if (!empty($arr['type'])) {
            $sql .= " AND type in ({$arr['type']})";
        }
        if (!empty($arr['name'])) {
            $sql .= " AND (name_ar LIKE '%{$arr['name']}%' OR name_en LIKE '%{$arr['name']}%')";
        }
        $entities = [];
        $result = $this->con->query($sql);
        while ($row = $result->fetch_assoc()) {
            $pool = true;
            if (!empty($arr['pool'])) {
                $pool = false;
                foreach (explode(',', $arr['pool']) as $id) {
                    if (in_array($id, explode(',', $row['pool']))) {
                        $pool = true;
                        break;
                    }
                }
            }

            $amenities = true;
            if (!empty($arr['amenities'])) {
                $amenities = false;
                foreach (explode(',', $arr['amenities']) as $id) {
                    if (in_array($id, explode(',', $row['amenities']))) {
                        $amenities = true;
                        break;
                    }
                }
            }

            $kitchenAmenities = true;
            if (!empty($arr['kitchenAmenities'])) {
                $kitchenAmenities = false;
                foreach (explode(',', $arr['kitchenAmenities']) as $id) {
                    if (in_array($id, explode(',', $row['kitchenAmenities']))) {
                        $kitchenAmenities = true;
                        break;
                    }
                }
            }

            $bedroom = true;
            if (!empty($arr['bedroom'])) {
                $bedroom = false;
                foreach (explode(',', $arr['bedroom']) as $id) {
                    if (in_array($id, explode(',', $row['bedroom']))) {
                        $bedroom = true;
                        break;
                    }
                }
            }

            $capacitance = true;
            if (!empty($arr['capacitance'])) {
                $capacitance = false;
                foreach (explode(',', $arr['capacitance']) as $id) {
                    if ($id == $row['capacitance']) {
                        $capacitance = true;
                        break;
                    }
                }
            }

            $countBedrooms = true;
            if (!empty($arr['countBedrooms'])) {
                $countBedrooms = false;
                foreach (explode(',', $arr['countBedrooms']) as $id) {
                    if ($id == $row['countBedrooms']) {
                        $countBedrooms = true;
                        break;
                    }
                }
            }

            if ($pool && $amenities && $kitchenAmenities && $bedroom && $capacitance && $countBedrooms) {
                $entities[] = $row;
            }
        }
        return $entities;
    }
}