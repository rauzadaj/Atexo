<?php

namespace App\Tests\Controller;

use App\Api\Controller\CardController;
use App\Service\CardService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CardControllerTest extends TestCase
{
    private CardService $cardService;
    private CardController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cardService = $this->getMockBuilder(CardService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->controller = new CardController();
    }

    public function testDrawAction(): void
    {
        $cards = [
            ['value' => 'Ace', 'suit' => 'Hearts'],
            ['value' => '10', 'suit' => 'Diamonds'],
            ['value' => 'Queen', 'suit' => 'Clubs'],
            ['value' => '2', 'suit' => 'Spades'],
            ['value' => 'Jack', 'suit' => 'Hearts'],
            ['value' => '9', 'suit' => 'Diamonds'],
            ['value' => 'King', 'suit' => 'Clubs'],
            ['value' => '3', 'suit' => 'Spades'],
            ['value' => '4', 'suit' => 'Hearts'],
            ['value' => '8', 'suit' => 'Diamonds'],
        ];

        $this->cardService->expects($this->once())
            ->method('drawCards')
            ->with(10)
            ->willReturn($cards);

        $response = $this->controller->draw($this->cardService);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($cards, json_decode($response->getContent(), true));
    }

    public function testSortAction(): void
    {
        $cards = [
            ['value' => 'Ace', 'suit' => 'Hearts'],
            ['value' => '10', 'suit' => 'Diamonds'],
            ['value' => 'Queen', 'suit' => 'Clubs'],
            ['value' => '2', 'suit' => 'Spades'],
        ];
        $sortedCards = [
            ['value' => '2', 'suit' => 'Spades'],
            ['value' => '10', 'suit' => 'Diamonds'],
            ['value' => 'Queen', 'suit' => 'Clubs'],
            ['value' => 'Ace', 'suit' => 'Hearts'],
        ];

        $request = new Request([], [], [], [], [], [], json_encode($cards));

        $this->cardService->expects($this->once())
            ->method('sortCards')
            ->with($cards)
            ->willReturn($sortedCards);

        $response = $this->controller->sort($request, $this->cardService);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($sortedCards, json_decode($response->getContent(), true));
    }
}
