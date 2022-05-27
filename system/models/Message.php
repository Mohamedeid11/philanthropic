<?php
class Message extends Model
{
    public $table = 'messages';
    public $columns = [
        'id', 'name', 'email' , 'address', 'content', 'date'
    ];


    public function sendMessage($name , $content , $email)
    {
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            return null;
        } else {
            include('models/Contact.php');
            $contactObj = new Contact();
            $user_email = $contactObj->getEmail();

            $to = $user_email;
            $subject = 'Message From Website ' . 'Client name: ' . $name;
            $message = 'Content Of Message: ' . $content = str_replace("\n.", "\n..", $content);
            $headers = 'From: Jmal Kharfosh Website' . "\r\n" .
                'Reply-To:' . $email . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            $sendMail = mail($to, $subject, $message, $headers);
            if ($sendMail) {
                return $sendMail ;
            }else{
                return  "Failed";
            }
        }

    }

    public function getByType($type)
    {
        $settings = array();
        $sql = "SELECT * FROM `" . $this->table . "` where type = '" . $type . "'";
        $result = $this->con->query($sql);
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($settings, $row);
            $x++;
        }
        return $settings;
    }
}