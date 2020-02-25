<?php


namespace App\Event;


use Broadway\Serializer\Serializable;

final class OrderWasCreatedEvent implements Serializable
{
    /** @var string */
    public $id;

    /** @var string */
    public $placeId;

    /** @var array */
    public $orderItems;

    /**
     * OrderWasCreatedEvent constructor.
     * @param string $id
     * @param string $placeId
     * @param array $orderItems
     */
    public function __construct(string $id, string $placeId, array $orderItems)
    {
        $this->id = $id;
        $this->placeId = $placeId;
        $this->orderItems = $orderItems;
    }


    public static function deserialize(array $data)
    {
        return new self(
            $data['id'],
            $data['placeId'],
            $data['orderItems']
        );
    }

    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'placeId' => $this->placeId,
            'orderItems' => $this->orderItems
        ];
    }

}