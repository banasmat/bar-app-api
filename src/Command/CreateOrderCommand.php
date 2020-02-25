<?php

namespace App\Command;

final class CreateOrderCommand
{
    /** @var string */
    public $orderId;

    /** @var string */
    public $placeId;

    /** @var array */
    public $orderItems;

    /**
     * CreateOrderCommand constructor.
     * @param string $orderId
     * @param string $placeId
     * @param array $orderItems
     */
    public function __construct(string $orderId, string $placeId, array $orderItems)
    {
        $this->orderId = $orderId;
        $this->placeId = $placeId;
        $this->orderItems = $orderItems;
    }
}