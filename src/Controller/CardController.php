<?php

namespace App\Controller;

use App\Entity\Card;
use App\Form\CardType;
use App\Repository\CardRepository;
use App\Service\GenerateName;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CardController extends AbstractController
{

    #[Route('/cards', name: 'app_cards')]
    public function index(CardRepository $cardRepository, Security $security): Response
    {
        $user = $this->getUser();

        $cards = [];

        // user admin findall
        if ($security->isGranted('ROLE_ADMIN')) {
            $cards = $cardRepository->findBy([], ['id' => 'DESC']);
        } else {
            $cards = $cardRepository->findBy(['user' => $user], ['id' => 'DESC']);
        }

        return $this->render('card/index.html.twig', [
            'cards' => $cards
        ]);
    }

    #[Route('/cards/add', name: 'app_card_add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        $card = new Card();
        $card->setUser($user);

        $form = $this->createForm(CardType::class, $card);
        $form->handleRequest($request);

        if ($form->issubmitted() && $form->isValid()) {
            $em->persist($card);
            $em->flush();

            return $this->redirectToRoute('app_cards');
        }

        return $this->render('card/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/cards/{id}/edit', name: 'app_card_edit')]
    public function edit($id, Request $request, EntityManagerInterface $em, CardRepository $cardRepository, Security $security): Response
    {
        $user = $this->getUser();
        $card = $cardRepository->findOneBy(['id' => $id]);

        if (!$security->isGranted('ROLE_ADMIN') && $card->getUser() !== $user) {
            return $this->redirectToRoute('app_cards');
        }

        if (!$card) {
            throw $this->createNotFoundException('Carte non trouvée');
        }

        $form = $this->createForm(CardType::class, $card);
        $form->handleRequest($request);

        if ($form->issubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_cards');
        }

        return $this->render('card/edit.html.twig', [
            'form' => $form,
            'card' => $card
        ]);
    }

    #[Route('/cards/{id}/delete', name: 'app_card_delete')]
    public function delete($id, EntityManagerInterface $em, CardRepository $cardRepository, Security $security): Response
    {
        $user = $this->getUser();
        $card = $cardRepository->findOneBy(['id' => $id]);

        if (!$security->isGranted('ROLE_ADMIN') && $card->getUser() !== $user) {
            return $this->redirectToRoute('app_cards');
        }

        if (!$card) {
            throw $this->createNotFoundException('Carte non trouvée');
        }

        $em->remove($card);
        $em->flush();

        return $this->redirectToRoute('app_cards');
    }

    private $generateName;

    public function __construct(GenerateName $generateName)
    {
        $this->generateName = $generateName;
    }

    #[Route('/cards/generate-name', name: 'app_card_generate')]
    public function generateName(): JsonResponse
    {
        $name = $this->generateName->generateName();
        return new JsonResponse(['name' => $name]);
    }
}
