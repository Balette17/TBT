<?php

namespace App\Controller;

use App\Repository\ToysRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(ToysRepository $toysRepository): Response
    {
        $toys = $toysRepository->findAll();
            return $this->render('product/index.html.twig', [
                'toys' => $toys,
        ]);
    }
}
