<?php


namespace App\Aggregate;


use App\Event\OrderStatusWasUpdatedEvent;
use App\Event\OrderWasCreatedEvent;
use Broadway\EventSourcing\EventSourcedAggregateRoot;

final class Order extends EventSourcedAggregateRoot
{
    const ORDER_STATUS_NONE = 0;
    const ORDER_STATUS_ORDERED = 1;
    const ORDER_STATUS_ACCEPTED = 2;
    const ORDER_STATUS_IN_PROGRESS = 3;
    const ORDER_STATUS_READY = 4;
    const ORDER_STATUS_FINISHED = 5;

    /** @var string */
    private $id;

    /** @var string */
    private $placeId;

    /** @var array */
    private $orderItems;

    /** @var int */
    private $status;

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

    public function updateStatus(int $status)
    {
        //TODO validate status
        $this->status = $status;
        $this->apply(
            new OrderStatusWasUpdatedEvent($this->id, $status)
        );
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
        $this->status = Order::ORDER_STATUS_NONE;
    }


}