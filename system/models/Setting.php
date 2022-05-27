<?php

class Setting extends Model
{
    public $table = 'settings';
    public $columns = [
        'id', 'android_version', 'android_link', 'ios_version', 'ios_link', 'copyright_name', 'copyright_link', 'facebook ',  'instgram', 'twitter' , 'header_logo', 'footer_logo', 'section_image', 'section_desc'
    ];


    public function getByLogo()
    {
        $sql = " SELECT logo FROM `" . $this->table . "` WHERE id = 1";

        $result = $this->con->query($sql);

        $row = mysqli_fetch_array($result);
        $logo = $row['logo'];
        return $logo;
    }

    public function settingShow()
    {
        $sql = " SELECT * FROM `" . $this->table . "`";

        $result = $this->con->query($sql);

        $row = mysqli_fetch_array($result);
        return $row;
    }

}