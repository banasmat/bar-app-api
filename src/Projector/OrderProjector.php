<?php


namespace App\Projector;


use App\Event\OrderStatusWasUpdatedEvent;
use App\Event\OrderWasCreatedEvent;
use App\ReadModel\Order;
use App\Repository\OrderReadRepository;
use Broadway\ReadModel\Projector;

final class OrderProjector extends Projector
{
    //TODO inject ReadModelRepo
    /** @var OrderReadRepository */
    private $orderRepo;

    /**
     * OrderProjector constructor.
     * @param OrderReadRepository $orderRepo
     */
    public function __construct(OrderReadRepository $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    protected function applyOrderWasCreatedEvent(OrderWasCreatedEvent $event): void
    {
        $order = new Order($event->id, \App\Aggregate\Order::ORDER_STATUS_NONE);
        $this->orderRepo->save($order);
    }

    protected function applyOrderStatusWasUpdatedEvent(OrderStatusWasUpdatedEvent $event): void
    {
        $order = $this->orderRepo->find($event->id);
        $order->setStatus($event->status);
        $this->orderRepo->update($order);
    }
}