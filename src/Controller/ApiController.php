<?php

namespace App\Controller;

use App\Repository\CardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{
    #[Route('/api/cards', name: 'api_cards')]
    public function index(
        CardRepository $cardRepository,
        SerializerInterface $serializer
    ): JsonResponse {
        $cards = $cardRepository->findAll();

        $context = [AbstractNormalizer::IGNORED_ATTRIBUTES => ['user', 'cards', 'imageFile', 'imageUpdatedAt']];

        $cardsJson = $serializer->serialize($cards, 'json', $context);

        $cardsArray = json_decode($cardsJson, true);


        return $this->json($cardsArray);
    }
}
