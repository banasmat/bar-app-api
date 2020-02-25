<?php


namespace App\Repository;


use App\Aggregate\Order;
use Broadway\EventHandling\EventBus;
use Broadway\EventSourcing\AggregateFactory\NamedConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStore;

class OrderWriteRepository implements OrderRepository
{
    /** @var EventSourcingRepository */
    private $eventSourcingRepository;

    public function __construct(
        EventStore $eventStore,
        EventBus $eventBus,
        array $eventStreamDecorators = []
    ) {
        $this->eventSourcingRepository = new EventSourcingRepository(
            $eventStore,
            $eventBus,
            Order::class,
            new NamedConstructorAggregateFactory(),
            $eventStreamDecorators
        );
    }

    public function get($orderId): ?Order
    {
        /** @var Order $order */
        $order = $this->eventSourcingRepository->load($orderId);

        return $order;
    }

    public function save(Order $order): void
    {
        $this->eventSourcingRepository->save($order);
    }
}