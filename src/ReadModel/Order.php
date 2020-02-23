<?php


namespace App\ReadModel;


use App\Event\OrderWasCreatedEvent;
use Broadway\ReadModel\SerializableReadModel;

// https://tsh.io/blog/cqrs-event-sourcing-implementation-php-3/

final class Order implements SerializableReadModel
{
    /** @var string */
    private $id;

    /**
     * Order constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public static function deserialize(array $data): self
    {
        return new static(
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