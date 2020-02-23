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
    "id": 1,
    "name": "Drink Bar",
    "address": "ul. Marszałkowska 1, 01-000 Warszawa",
    "category": "bar",
    "imgUrl": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRosGYfJzKSm7wjTDd5JcRTJa6DI751qdfCpot83FdVBHAGoWs3&s"
  },
  {
    "id": 2,
    "name": "Drink Bar",
    "address": "ul. Marszałkowska 1, 01-000 Warszawa",
    "category": "bar",
    "imgUrl": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRosGYfJzKSm7wjTDd5JcRTJa6DI751qdfCpot83FdVBHAGoWs3&s"
  },
  {
    "id": 3,
    "name": "Drink Bar",
    "address": "ul. Marszałkowska 1, 01-000 Warszawa",
    "category": "bar",
    "imgUrl": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRosGYfJzKSm7wjTDd5JcRTJa6DI751qdfCpot83FdVBHAGoWs3&s"
  }
]';

        return new JsonResponse(json_decode($mockData, true));
    }
}