<?php


namespace App\Event;


use Broadway\Serializer\Serializable;

final class OrderStatusWasUpdatedEvent implements Serializable
{
    /** @var string */
    public $id;

    /** @var string */
    public $status;

    /**
     * OrderStatusWasUpdatedEvent constructor.
     * @param string $id
     * @param string $status
     */
    public function __construct(string $id, string $status)
    {
        $this->id = $id;
        $this->status = $status;
    }

    public static function deserialize(array $data)
    {
        return new self(
            $data['id'],
            $data['status']
        );
    }

    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status
        ];
    }

}