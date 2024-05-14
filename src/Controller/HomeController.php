<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $email = 'yoyoyo';
        new User();
        if ($this->getUser() !== null) {
            $email = $this->getUser()->getEmail();
        }

        return $this->render('pages/home/index.html.twig', [
            'email' => $email,
        ]);
    }
}
