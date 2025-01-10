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
        $typesCards = $typeRepository->findAll();
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
                        'rgb(226, 109, 90)',
                        'rgb(106, 4, 29)',
                        'rgb(252, 158, 79)',
                        'rgb(52, 211, 153)',
                        'rgb(0, 70, 67)',
                    ],
                    'borderWidth' => 0,
                    'borderRadius' => 5,
                    'spacing' => 5,
                    'data' => $dataClass,
                ],
            ],
        ]);

        $chartClass->setOptions([
            'plugins' => [
                'legend' => [
                    "position" => "right",
                    "align" => "middle",
                    'labels' => [
                        'color' => '#d9e6eb',
                        'boxWidth' => 20,
                        'boxHeight' => 20,
                        'usePointStyle' => true,
                        'pointStyle' => 'circle',
                    ],
                ],
            ],
        ]);

        // chart type
        $chartType = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);

        $labelsType = [];
        $dataType = [];

        foreach ($typesCards as $type) {
            $labelsType[] = $type->getName();
            $dataType[] = $type->getCards()->count();
        }

        $chartType->setData([
            'labels' => $labelsType,
            'datasets' => [
                [
                    'label' => 'Nombre de cartes par type',
                    'backgroundColor' => [
                        'rgb(0, 70, 67)',
                        'rgb(52, 211, 153)',
                    ],
                    'borderWidth' => 0,
                    'borderRadius' => 5,
                    'spacing' => 5,
                    'data' => $dataType,
                ],
            ],
        ]);

        $chartType->setOptions([
            'plugins' => [
                'legend' => [
                    "position" => "right",
                    "align" => "middle",
                    'labels' => [
                        'color' => '#d9e6eb',
                        'boxWidth' => 20,
                        'boxHeight' => 20,
                        'usePointStyle' => true,
                        'pointStyle' => 'circle',
                        'fontStyle' => 'Montserrat',
                    ],
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
