<?php


namespace App\Controller;


use App\Aggregate\Order;
use App\Command\CreateOrderCommand;
use App\Repository\OrderReadRepository;
use Broadway\CommandHandling\CommandBus;
use Broadway\UuidGenerator\UuidGeneratorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController
{

    private $commandBus;
    private $uuidGenerator;

    public function __construct(
        CommandBus $commandBus,
        UuidGeneratorInterface $uuidGenerator
    ) {
        $this->commandBus = $commandBus;
        $this->uuidGenerator = $uuidGenerator;
    }

    /**
     * @Route("/create-order", name="create_order")
     */
    public function createOrder(Request $request, OrderReadRepository $orderBroadwayRepository): Response
    {
        $data = json_decode($request->getContent(), true);

        $orderId = $this->uuidGenerator->generate();
        $command = new CreateOrderCommand($orderId, $data['placeId'], $data['orderItems']);

        $this->commandBus->dispatch($command);

        return new JsonResponse(['id' => $orderId]);
    }

    /**
     * @Route("/order/{id}", name="get_order")
     */
    public function getOrder(OrderReadRepository $orderBroadwayRepository, $id): Response
    {
        $order = $orderBroadwayRepository->find($id);

        return new JsonResponse($order);
    }

    /**
     * @Route("/orders/{placeId}", name="get_orders")
     */
    public function getOrders(OrderReadRepository $orderBroadwayRepository, $placeId): Response
    {
        $order = $orderBroadwayRepository->findActiveByPlaceId($placeId);

        return new JsonResponse($order);
    }
}