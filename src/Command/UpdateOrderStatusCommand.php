<?php

namespace App\Command;

final class UpdateOrderStatusCommand
{
    /** @var string */
    public $orderId;

    /** @var int */
    public $status;

    /**
     * CreateOrderCommand constructor.
     * @param string $orderId
     * @param string $status
     */
    public function __construct(string $orderId, string $status)
    {
        $this->orderId = $orderId;
        $this->status = $status;
    }
}