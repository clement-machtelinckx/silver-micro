<?php

namespace App\Controller;


use App\Entity\Restaurant;
use App\Entity\Reservation;
use App\Form\NewReservationType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}', name: 'reservation.new', methods: ['GET', 'POST'])]
    public function newReservation(Restaurant $restaurant, Request $request, EntityManagerInterface $manager): Response
    {
        $reservation = new Reservation();
    
        $form = $this->createForm(NewReservationType::class, $reservation);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // récupère l'utilisateur connecté
            $user = $this->getUser();
    
            // récupère l'ID du restaurant sélectionné
            $restaurantId = $restaurant->getId();
    
            // définit l'utilisateur et le restaurant pour la réservation
            $reservation->setUser($user);
            $reservation->setRestaurant($restaurant);
    
            // définit la date et l'heure de la réservation
            $reservation->setDateTime(new DateTimeImmutable('now'));
    
            // persiste et enregistre la réservation dans la base de données
            $manager->persist($reservation);
            $manager->flush();
    
            $this->addFlash('success', 'La réservation a bien été ajoutée');
    
            return $this->redirectToRoute('restaurants');
        }
    
        return $this->render('pages/reservations/new.html.twig', [
            'restaurant' => $restaurant,
            'form' => $form->createView(),
        ]);
    }
    
}
