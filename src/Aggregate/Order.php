<?php


namespace App\Aggregate;


use App\Event\OrderWasCreatedEvent;
use Broadway\EventSourcing\EventSourcedAggregateRoot;

final class Order extends EventSourcedAggregateRoot
{
    /** @var string */
    private $id;

    public static function create(
        string $orderId
    ): self {
        $order = new static();
        $order->apply(
            new OrderWasCreatedEvent($orderId)
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
    }
}