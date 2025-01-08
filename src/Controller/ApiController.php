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

        $context = [AbstractNormalizer::IGNORED_ATTRIBUTES => ['user', 'cards', 'imageFile', 'imageUpdatedAt', 'updatedAt', 'createdAt', 'id']];

        $cardsJson = $serializer->serialize($cards, 'json', $context);

        $cardsArray = json_decode($cardsJson, true);

        // Add the base URL to the imageName field
        foreach ($cardsArray as &$card) {
            if (isset($card['imageName'])) {
                $card['imageName'] = 'https://127.0.0.1:8000/images/cards/' . $card['imageName'];
            }
        }


        return $this->json($cardsArray);
    }
}
