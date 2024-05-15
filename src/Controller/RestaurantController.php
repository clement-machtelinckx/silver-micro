<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Repository\RestaurantRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RestaurantController extends AbstractController
{
    #[Route('/restaurants', name: 'restaurants')]
    public function index(RestaurantRepository $restaurantRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $restaux = $paginator->paginate(
            $restaurantRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/restaurants/index.html.twig', [
            'restaux' => $restaux,
            'pagination' => [
                'page' => $request->query->getInt('page', 1),
                'limit' => 10,
                'count' => count($restaurantRepository->findAll()),
            ],
        ]);
    }

    #[Route('/restaurants/{id}', name: 'restaurant.show', methods: ['GET'])]
    public function show(Restaurant $restaurant): Response
    {

        $restaurants = $restaurant;

        return $this->render('pages/restaurants/show.html.twig', [
            'restaurant' => $restaurants,
        ]);
    }
}

