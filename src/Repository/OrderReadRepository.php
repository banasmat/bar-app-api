<?php


namespace App\Repository;


use App\ReadModel\DBALRepository;

class OrderReadRepository extends DBALRepository
{

    public function findActiveByPlaceId($placeId): array
    {
        return $this->findBy([
            'placeId' => $placeId,
            //'status' => NOT finished
        ]);
    }
}