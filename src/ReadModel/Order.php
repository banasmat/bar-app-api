<?php


namespace App\ReadModel;


use App\Event\OrderWasCreatedEvent;
use Broadway\ReadModel\SerializableReadModel;

// https://tsh.io/blog/cqrs-event-sourcing-implementation-php-3/

final class Order implements SerializableReadModel
{
    /** @var string */
    private $id;

    /** @var string */
    private $placeId;

    /** @var int */
    private $status;

    /** @var array */
    private $data;

    /**
     * Order constructor.
     * @param string $id
     * @param string $placeId
     * @param int $status
     * @param array $data
     */
    public function __construct(string $id, string $placeId, int $status, array $data)
    {
        $this->id = $id;
        $this->placeId = $placeId;
        $this->status = $status;
        $this->data = $data;
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

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getPlaceId(): string
    {
        return $this->placeId;
    }

    public static function deserialize(array $data): self
    {
        return new static(
            $data['id'],
            $data['placeId'],
            $data['status'],
            $data['data']
        );
    }

    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'placeId' => $this->placeId,
            'status' => $this->status,
            'data' => $this->data,
        ];
    }


}