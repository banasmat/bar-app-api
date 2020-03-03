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
     * @param int $status
     */
    public function __construct(string $id, int $status)
    {
        $this->id = $id;
        $this->status = $status;
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
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