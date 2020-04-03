<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index()
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
     * @Route("/apiData", name="apiData")
     */
    public function getWeatherData(Request $request)
    {
        $client = HttpClient::create();
        $data = $client->request('GET', 'https://api.openweathermap.org/data/2.5/weather?q=mulhouse&appid=fe47afa19eb8b58d4222de3869788634');
        dd($request);
        $response = new JsonResponse();
        return $response::fromJsonString($data->getContent());
    }
}
