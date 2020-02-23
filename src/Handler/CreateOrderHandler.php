<?php

namespace App\Handler;

use App\Command\CreateOrderCommand;
use App\Aggregate\Order;
use App\Repository\OrderRepository;
use Broadway\CommandHandling\SimpleCommandHandler;

final class CreateOrderHandler extends SimpleCommandHandler
{
    /** @var OrderRepository */
    private $orderRepo;

    /**
     * CreateOrderHandler constructor.
     * @param OrderRepository $orderRepo
     */
    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function handleCreateOrderCommand(CreateOrderCommand $command)
    {
        $order = Order::create($command->orderId);

        $this->orderRepo->save($order);
    }

}