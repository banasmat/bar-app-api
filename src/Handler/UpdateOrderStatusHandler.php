<?php

namespace App\Handler;

use App\Command\CreateOrderCommand;
use App\Aggregate\Order;
use App\Command\UpdateOrderStatusCommand;
use App\Repository\OrderRepository;
use App\Repository\OrderWriteRepository;
use Broadway\CommandHandling\SimpleCommandHandler;

final class UpdateOrderStatusHandler extends SimpleCommandHandler
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

    public function handleUpdateOrderStatusCommand(UpdateOrderStatusCommand $command)
    {
        $order = $this->orderRepo->get($command->orderId);
        $order->updateStatus($command->status);

        $this->orderRepo->save($order);
    }

}