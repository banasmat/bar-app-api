<?php


namespace App\Projector;


use App\Event\OrderWasCreatedEvent;
use App\ReadModel\Order;
use App\Repository\OrderRepository;
use Broadway\ReadModel\Projector;

final class OrderProjector extends Projector
{
    //TODO inject ReadModelRepo
    /** @var OrderRepository */
    private $orderRepo;

    /**
     * OrderProjector constructor.
     * @param OrderRepository $orderRepo
     */
    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    protected function applyOrderWasCreatedEvent(OrderWasCreatedEvent $event): void
    {
        $order = new Order($event->id);
        $this->orderRepo->save($order);
    }
}