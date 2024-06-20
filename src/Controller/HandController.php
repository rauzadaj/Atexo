<?php

namespace App\Controller;

use App\Service\CardService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HandController extends AbstractController
{
    #[Route('/draw', name: 'card_drawn', methods: ['GET'])]
    public function drawView(Request $request, CardService $cardService): Response
    {
        return $this->render('/card/index.html.twig', []);
    }
}
