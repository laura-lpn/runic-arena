<?php

namespace App\Controller;

use App\Entity\Card;
use App\Form\CardType;
use App\Repository\CardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CardController extends AbstractController
{

    #[Route('/cards', name: 'app_cards')]
    public function index(CardRepository $cardRepository): Response
    {
        $user = $this->getUser();
        $cards = $cardRepository->findBy(['user' => $user]);

        return $this->render('card/index.html.twig', [
            'cards' => $cards,
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

    #[Route('/cards/{id}', name: 'app_card_show')]
    public function show($id, CardRepository $cardRepository): Response
    {
        $user = $this->getUser();
        $card = $cardRepository->findOneBy(['id' => $id, 'user' => $user]);

        if (!$card) {
            throw $this->createNotFoundException('Carte non trouvée');
        }

        return $this->render('card/show.html.twig', [
            'card' => $card,
        ]);
    }

    #[Route('/cards/{id}/edit', name: 'app_card_edit')]
    public function edit($id, Request $request, EntityManagerInterface $em, CardRepository $cardRepository): Response
    {
        $user = $this->getUser();
        $card = $cardRepository->findOneBy(['id' => $id, 'user' => $user]);

        if (!$card) {
            throw $this->createNotFoundException('Carte non trouvée');
        }

        $form = $this->createForm(CardType::class, $card);
        $form->handleRequest($request);

        if ($form->issubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_card_show', ['id' => $card->getId()]);
        }

        return $this->render('card/edit.html.twig', [
            'form' => $form,
            'card' => $card
        ]);
    }

    #[Route('/cards/{id}/delete', name: 'app_card_delete')]
    public function delete($id, EntityManagerInterface $em, CardRepository $cardRepository): Response
    {
        $user = $this->getUser();
        $card = $cardRepository->findOneBy(['id' => $id, 'user' => $user]);

        if (!$card) {
            throw $this->createNotFoundException('Carte non trouvée');
        }

        $em->remove($card);
        $em->flush();

        return $this->redirectToRoute('app_cards');
    }
}
