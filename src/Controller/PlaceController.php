<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PlaceController
{
    /**
     * @Route("/places", name="place_list")
     */
    public function places(Request $request)
    {
        $search = $request->query->get('search');
        $lat = $request->query->get('lat');
        $lon = $request->query->get('lon');

        $mockData =
'[
  {
    "id": "7e77e904-60bc-46a6-aeb6-44fa6d54cdf8",
    "name": "Drink Bar",
    "address": "ul. Marszałkowska 1, 01-000 Warszawa",
    "category": "bar",
    "imgUrl": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRosGYfJzKSm7wjTDd5JcRTJa6DI751qdfCpot83FdVBHAGoWs3&s"
  },
  {
    "id": "45c5b054-bd91-4aef-9570-0e1b2d967b39",
    "name": "Drink Bar",
    "address": "ul. Marszałkowska 1, 01-000 Warszawa",
    "category": "bar",
    "imgUrl": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRosGYfJzKSm7wjTDd5JcRTJa6DI751qdfCpot83FdVBHAGoWs3&s"
  },
  {
    "id": "1cb0288c-c1dd-44a3-af79-96565cd04b26",
    "name": "Drink Bar",
    "address": "ul. Marszałkowska 1, 01-000 Warszawa",
    "category": "bar",
    "imgUrl": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRosGYfJzKSm7wjTDd5JcRTJa6DI751qdfCpot83FdVBHAGoWs3&s"
  }
]';

        return new JsonResponse(json_decode($mockData, true));
    }

    /**
     * @Route("/menu/{placeId}", name="menu")
     */
    public function menu(Request $request, $placeId)
    {
        $search = $request->query->get('search');
        $lat = $request->query->get('lat');
        $lon = $request->query->get('lon');

        $mockData =
'{
  "place": {
    "id": "7e77e904-60bc-46a6-aeb6-44fa6d54cdf8",
    "name": "Drink Bar"
  },
  "menuItems": [
    {
      "id": 1,
      "placeId": "7e77e904-60bc-46a6-aeb6-44fa6d54cdf8",
      "name": "Piwo 0,5",
      "price": 800,
      "imgUrl": "https://pbs.twimg.com/profile_images/692310978579599361/nsHPRTcr_400x400.jpg"
    },
    {
      "id": 2,
      "placeId": "7e77e904-60bc-46a6-aeb6-44fa6d54cdf8",
      "name": "Piwo 0,3",
      "price": 700,
      "imgUrl": "https://pbs.twimg.com/profile_images/692310978579599361/nsHPRTcr_400x400.jpg"
    },
    {
      "id": 3,
      "placeId": "7e77e904-60bc-46a6-aeb6-44fa6d54cdf8",
      "name": "Kawa",
      "price": 800,
      "imgUrl": "https://pbs.twimg.com/profile_images/692310978579599361/nsHPRTcr_400x400.jpg"
    }
  ]
}';

        return new JsonResponse(json_decode($mockData, true));
    }
}