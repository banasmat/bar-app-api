<?php


namespace App\Repository;


use App\Aggregate\Order;
use App\ReadModel\DBALRepository;
use Broadway\ReadModel\Identifiable;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

class OrderReadRepository extends DBALRepository
{

    public function findActiveByPlaceId($placeId): array
    {
        return $this->findBy([
            'placeId' => $placeId,
            'status' => Order::ORDER_STATUS_ACCEPTED
        ]);
    }

    protected function getInsertData(Identifiable $readModel)
    {
        return array_merge(parent::getInsertData($readModel), [
            'status' => $readModel->getStatus(),
            'placeId' => $readModel->getPlaceId(),
        ]);
    }

    protected function getUpdateData(Identifiable $readModel)
    {
        return array_merge(parent::getUpdateData($readModel), [
            'status' => $readModel->getStatus(),
            'placeId' => $readModel->getPlaceId(),
        ]);
    }
    
    public function configureTable(Schema $schema): Table
    {
        $table = parent::configureTable($schema);
        $table->addColumn('placeId', 'guid', ['length' => 36]);
        $table->addColumn('status', 'integer');

        return $table;
    }
}