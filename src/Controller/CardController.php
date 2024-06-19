<?php

namespace App\Controller;

use App\Service\CardService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CardController extends AbstractController
{
    #[Route('/api/card/draw', name: 'card_draw', methods: ['GET'])]
    public function draw(CardService $cardService): JsonResponse
    {
        $cards = $cardService->drawCards(10);
        return new JsonResponse($cards);
    }
    #[Route('/api/card/sort', name: 'card_sort', methods: ['POST'])]
    public function sort(Request $request, CardService $cardService): JsonResponse
    {
        $cards = json_decode($request->getContent(), true);
        $sortedCards = $cardService->sortCards($cards);

        return new JsonResponse($sortedCards);
    }

    #[Route('/draw', name: 'card_drawn', methods: ['GET'])]
    public function drawView(Request $request, CardService $cardService): Response
    {
        return $this->render('/card/index.html.twig', []);
    }
}
