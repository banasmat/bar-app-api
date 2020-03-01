<?php

namespace App\Handler;

use App\Command\CreateOrderCommand;
use App\Aggregate\Order;
use App\Repository\OrderWriteRepository;
use Broadway\CommandHandling\SimpleCommandHandler;

final class CreateOrderHandler extends SimpleCommandHandler
{
    /** @var OrderWriteRepository */
    private $orderRepo;

    /**
     * CreateOrderHandler constructor.
     * @param OrderWriteRepository $orderRepo
     */
    public function __construct(OrderWriteRepository $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function handleCreateOrderCommand(CreateOrderCommand $command)
    {
        $order = Order::create($command->orderId, $command->placeId, $command->orderItems);

        $this->orderRepo->save($order);
    }

}