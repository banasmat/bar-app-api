<?php


namespace App\Controller;


use App\Aggregate\Order;
use App\Command\CreateOrderCommand;
use App\Command\UpdateOrderStatusCommand;
use App\Repository\OrderReadRepository;
use Broadway\CommandHandling\CommandBus;
use Broadway\UuidGenerator\UuidGeneratorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
    public function createOrder(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $orderId = $this->uuidGenerator->generate();
        $command = new CreateOrderCommand($orderId, $data['placeId'], $data['orderItems']);

        $this->commandBus->dispatch($command);

        return new JsonResponse([
            'ack' => 'SUCCESS',
            'orderId' => $orderId,
            'paymentUrl' => '/payment-mock' //TODO request payment etc.
        ]);
    }

    /**
     * @Route("/order/{id}", name="update_order", methods={"POST"})
     */
    public function updateOrder(Request $request, $id): Response
    {
        //TODO vaildate placeId etc.

        $data = json_decode($request->getContent(), true);

        $command = new UpdateOrderStatusCommand($id, $data['status']);

        $this->commandBus->dispatch($command);

        return new JsonResponse([
            'ack' => 'SUCCESS'
        ]);
    }

    /**
     * @Route("/order/{id}", name="get_order", methods={"GET"})
     */
    public function getOrder(OrderReadRepository $orderBroadwayRepository, $id): Response
    {
        $order = $orderBroadwayRepository->find($id);

        if(null === $order){
            throw new NotFoundHttpException(sprintf('Order with ID %s not found.', $id));
        }

        return new JsonResponse([
            'orderId' => $order->getId(),
            'status' => $order->getStatus()
        ]);
    }

    /**
     * @Route("/orders/{placeId}", name="get_orders")
     */
    public function getOrders(OrderReadRepository $orderBroadwayRepository, $placeId): Response
    {
        $orders = $orderBroadwayRepository->findActiveByPlaceId($placeId);

        //TODO save json_encoded data that will be returned without decoding OR don't encode it at all in REad Model...

        return new JsonResponse(array_map(function($order){
            $order = json_decode($order['data'], true)['payload'];
            $order['createdAt'] = substr($order['createdAt']['date'], 0, -7);
            return $order;
        }, $orders));
    }
}