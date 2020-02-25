<?php


namespace App\Aggregate;


use App\Event\OrderWasCreatedEvent;
use Broadway\EventSourcing\EventSourcedAggregateRoot;

final class Order extends EventSourcedAggregateRoot
{
    /** @var string */
    private $id;

    /** @var string */
    private $placeId;

    /** @var array */
    private $orderItems;

    public static function create(
        string $orderId,
        string $placeId,
        array $orderItems
    ): self {
        $order = new static();
        $order->apply(
            new OrderWasCreatedEvent($orderId, $placeId, $orderItems)
        );

        return $order;
    }

    public static function instantiateForReconstitution(): self
    {
        return new static();
    }

    public function getAggregateRootId(): string
    {
        return $this->id;
    }

    protected function applyOrderWasCreatedEvent(OrderWasCreatedEvent $event): void
    {
        $this->id = $event->id;
        $this->placeId = $event->placeId;
        $this->orderItems = $event->orderItems;    //TODO create collection
    }
}