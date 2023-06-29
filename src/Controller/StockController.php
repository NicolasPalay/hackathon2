<?php

namespace App\Controller;

use App\Repository\DeviceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StockController extends AbstractController
{
    #[Route('/stock', name: 'app_stock', methods: ['GET'])]
    public function index(DeviceRepository $deviceRepository): Response
    {
        return $this->render('stock/index.html.twig', [
            'controller_name' => 'StockController',
            'devices' => $deviceRepository->findAll(),
        ]);
    }
}
