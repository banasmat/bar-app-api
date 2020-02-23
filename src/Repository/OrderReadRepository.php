<?php


namespace App\Repository;


use App\ReadModel\Order;
use Broadway\ReadModel\ElasticSearch\ElasticSearchRepositoryFactory;
use Broadway\ReadModel\Repository;

class OrderReadRepository implements OrderRepository
{
    /**
     * @var Repository
     */
    private $repository;

    public function __construct(ElasticSearchRepositoryFactory $repositoryFactory)
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
}