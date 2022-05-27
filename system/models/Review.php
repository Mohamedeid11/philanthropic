<?php


class Review extends Model
{
    public $table = 'reviews';
    public $columns = [
        'id', 'entity_id','client_id', 'rate', 'comment', 'date'
    ];

    public function getByEntity($entity_id)
    {
        $sql = "SELECT * FROM `" . $this->table . "` WHERE entity_id = '" . $entity_id . "'";

        $result = $this->con->query($sql);

        $reviews = array();
        $clientObj = new Client();
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $row['client'] = $clientObj->getById($row['client_id']);
            array_push($reviews, $row);
            $x++;
        }
        return $reviews;
    }

    public function getEntityTotalReview($entity_id)
    {
        $sql = "SELECT rate FROM `" . $this->table . "` WHERE entity_id = '" . $entity_id . "'";

        $result = $this->con->query($sql);

        $totalRate = 0;
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $totalRate += (int) $row['rate'];
            $x++;
        }
        return $x == 1 ? '0' : $totalRate / ($x - 1);
    }

    public function getEntityTotalReviewCount($entity_id)
    {
        $sql = "SELECT rate FROM `" . $this->table . "` WHERE entity_id = '" . $entity_id . "'";
        $result = $this->con->query($sql);

        $totalRate = 0;
        $x = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $totalRate += (int) $row['rate'];
            $x++;
        }
        return $x == 1 ?
            [
                'totalRate' => '0',
                'countRate' => 0
            ] :
            [
                'totalRate' => number_format($totalRate / ($x - 1), 2),
                'countRate' => $x - 1
            ];
    }

    public function hasReview($client_id, $entity_id)
    {
        $sql = "SELECT * FROM `" . $this->table . "` WHERE client_id = '" . $client_id .
            "' AND entity_id = " . $entity_id . " LIMIT 1";

        $result = $this->con->query($sql);
        return mysqli_fetch_assoc($result);
    }

    public function deleteEntityReviews($entity_id)
    {
        $sql = "DELETE FROM `" . $this->table .
            "` WHERE `" . $this->table . "`.`entity_id` = " . $entity_id;

        return $this->con->query($sql);
    }
}