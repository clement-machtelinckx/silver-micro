<?php

namespace App\Controller;


use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user')]
    public function show(UserInterface $user, ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findBy(['user' => $user]);
    
        return $this->render('pages/user/profile.html.twig', [
            'user' => $user,
            'reservations' => $reservations,
        ]);
    }
    
}
