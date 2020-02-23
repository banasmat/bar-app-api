<?php


namespace App\Event;


use Broadway\Serializer\Serializable;

final class OrderWasCreatedEvent implements Serializable
{
    /** @var string */
    public $id;

    /**
     * OrderWasCreatedEvent constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function deserialize(array $data)
    {
        return new self(
            $data['id']
        );
    }

    public function serialize(): array
    {
        return [
            'id' => $this->id,
        ];
    }

}