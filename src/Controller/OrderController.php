<?php


namespace App\Controller;


use App\Repository\OrderReadRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class OrderController
{
    public function usersList(OrderReadRepository $orderBroadwayRepository): Response
    {
        $orders = $orderBroadwayRepository->findAll();

        return new JsonResponse(['orders' => $orders]);


        /*TODO enpoints:
         * places
         * menu {place}
         * create order (payment request)
         * payment ack
         * get orders {place}(with websockets: push to bartender instead)
         * get order status (with websockets: push to client instead)
         */
    }
}