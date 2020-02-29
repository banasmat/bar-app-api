<?php


namespace App\ReadModel;


use App\Event\OrderWasCreatedEvent;
use Broadway\ReadModel\SerializableReadModel;

// https://tsh.io/blog/cqrs-event-sourcing-implementation-php-3/

final class Order implements SerializableReadModel
{
    /** @var string */
    private $id;

    /** @var int */
    private $status;

    /**
     * Order constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
        $this->status = \App\Aggregate\Order::ORDER_STATUS_NONE;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public static function deserialize(array $data): self
    {
        return new static(
            $data['id'],
            $data['status']
        );
    }

    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
        ];
    }


}