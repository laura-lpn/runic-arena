<?php

namespace App\Controller;

use App\Repository\CardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PublicController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CardRepository $cardRepository): Response
    {
        $lastCards = $cardRepository->findBy([], ['id' => 'DESC'], 5);

        return $this->render('public/index.html.twig', [
            'lastCards' => $lastCards
        ]);
    }
}
