<?php


namespace App\Repository;


use App\ReadModel\DBALRepository;
use App\ReadModel\DBALRepositoryFactory;
use App\ReadModel\Order;

class OrderReadRepository implements OrderRepository
{
    /**
     * @var DBALRepository
     */
    private $repository;

    public function __construct(DBALRepositoryFactory $repositoryFactory)
    {
        $this->repository = $repositoryFactory->create('order_repository', Order::class);
    }

    public function save(Order $order): void
    {
        $this->repository->save($order);
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /** @return Order */
    public function find($id): ?Order
    {
        return $this->repository->find($id);
    }

    public function findActiveByPlaceId($placeId): array
    {
        return $this->repository->findBy([
            'placeId' => $placeId,
            //'status' => NOT finished
        ]);
    }
}