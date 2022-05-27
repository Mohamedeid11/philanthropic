<?php

class Feature extends Model
{
    public $table = 'features';
    public $columns = [
        'id', 'type', 'name_ar', 'name_en', 'entity_id','display', 'date'
    ];

    public function getByEntity($entity_id, $lang = 'en', $type = 1)
    {
        $sql = "SELECT *, name_" . $lang . " AS name FROM `" . $this->table . "` WHERE entity_id = '" . $entity_id . "'";

        $result = $this->con->query($sql);

        $features = array();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $features[$row['type']][] = $row['name'];
            $x++;
        }
        $arr = [];
        foreach($features as $key => $feature) {
            if ($key != 'payment' && $key != 'size' && $key != 'period') {
                $item = [
                    'title' => $this->trans($lang, $key),
                    'content' => $feature
                ];
                if ($type == 4) {
                    $item['icon'] = 'http://poolbhr.com/admin/api/uploads/stadiums/' . $key . '.png';
                } else {
                    $item['icon'] = 'http://poolbhr.com/admin/api/uploads/features/' . $key . '.png';
                }
                $arr[] = $item;
            }
        }
        return $arr;
    }
    
    private function trans($lang, $key)
    {
        $arr = [
            'en' => [
                'sets' => 'Sets',
                'pools' => 'Pools',
                'amenities' => 'Amenities',
                'wc' => 'WC',
                'wc_amenities' => 'WC Amenities',
                'kitchen_amenities' => 'Kitchen Amenities',
                'bedrooms' => 'Bedrooms',
                'ball' => 'Ball',
                'numbers' => 'Numbers',
                'covered' => 'Covered',
                'water' => 'Water',
                'shower' => 'Shower'
            ],
            'ar' => [
                'sets' => 'المجالس و الجلسات',
                'pools' => 'المسابح',
                'amenities' => 'المرافق',
                'wc' => 'دورات المياه',
                'wc_amenities' => 'مرافق دورات المياه',
                'kitchen_amenities' => 'مرافق المطبخ',
                'bedrooms' => 'غرف النوم',
                'ball' => 'كرة',
                'numbers' => 'أرقام',
                'covered' => 'مغطى',
                'water' => 'مياه',
                'shower' => 'دش'
            ]
        ];
        
        if (key_exists($key, $arr[$lang])) {
            return $arr[$lang][$key];
        } else {
            return $key;
        }
    }
    
    public function getByType($type, $entity_id, $lang = 'en')
    {
        $sql = "SELECT *, name_" . $lang . " AS name FROM `" . $this->table . "` WHERE type = '" . $type . "' AND entity_id = " . $entity_id;

        $arr = array();
        $features = array();
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $features[] = $row['name'];
            $x++;
        }
        return $features;
    }

    public function deleteEntityFeatures($entity_id)
    {
        $sql = "DELETE FROM `" . $this->table .
            "` WHERE `" . $this->table . "`.`entity_id` = " . $entity_id;

        return $this->con->query($sql);
    }
}