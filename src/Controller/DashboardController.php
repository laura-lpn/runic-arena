<?php

namespace App\Controller;

use App\Repository\CardRepository;
use App\Repository\ClassCardRepository;
use App\Repository\TypeCardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(ChartBuilderInterface $chartBuilder, ClassCardRepository $classRepository, CardRepository $cardRepository, TypeCardRepository $typeRepository): Response
    {
        $cards = $cardRepository->findAll();
        $types = $typeRepository->findAll();
        $classCards = $classRepository->findAll();

        $NbCards = count($cards);

        // chart class
        $chartClass = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);

        $labelsClass = [];
        $dataClass = [];

        foreach ($classCards as $classCard) {
            $labelsClass[] = $classCard->getName();
            $dataClass[] = $classCard->getCards()->count();
        }

        $chartClass->setData([
            'labels' => $labelsClass,
            'datasets' => [
                [
                    'label' => 'Nombre de cartes par classe',
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(32, 245, 42)'
                    ],
                    'data' => $dataClass,
                ],
            ],
        ]);

        // chart type
        $chartType = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);

        $labelsType = [];
        $dataType = [];

        foreach ($types as $type) {
            $labelsType[] = $type->getName();
            $dataType[] = $type->getCards()->count();
        }

        $chartType->setData([
            'labels' => $labelsType,
            'datasets' => [
                [
                    'label' => 'Nombre de cartes par type',
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                    ],
                    'data' => $dataType,
                ],
            ],
        ]);




        return $this->render('dashboard/index.html.twig', [
            'NbCards' => $NbCards,
            'chartClass' => $chartClass,
            'chartType' => $chartType,
        ]);
    }
}
