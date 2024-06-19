<?php

namespace App\Service;

use App\Entity\Card;

class CardService
{
    private const COLORS = ['Carreaux', 'Coeur', 'Pique', 'Trèfle'];
    private const VALUES = ['AS', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Valet', 'Dame', 'Roi'];

    public function drawCards(int $numCards): array
    {
        $cards = [];
        $drawnCards = [];

        while (count($cards) < $numCards) {
            $color = self::COLORS[array_rand(self::COLORS)];
            $value = self::VALUES[array_rand(self::VALUES)];

            $cardString = $color . '-' . $value;
            if (!in_array($cardString, $drawnCards)) {
                $cards[] = new Card($color, $value); // Create a Card object
                $drawnCards[] = $cardString;
            }
        }

        return $cards;
    }
//
//    public function sortCards(array $cards): array
//    {
//        usort($cards, function ($a, $b) {
//            $colorComparison = array_search($a['color'], self::COLORS) <=> array_search($b['color'], self::COLORS);
//            if ($colorComparison !== 0) {
//                return $colorComparison;
//            }
//            return array_search($a['value'], self::VALUES) <=> array_search($b['value'], self::VALUES);
//        });
//
//        return $cards;
//    }

    public function sortCards(array $cards): array
    {
        // Précalcul des positions des couleurs et des valeurs
        $colorPositions = array_flip(self::COLORS);
        $valuePositions = array_flip(self::VALUES);

        usort($cards, function ($a, $b) use ($colorPositions, $valuePositions) {
            $colorComparison = $colorPositions[$a['color']] <=> $colorPositions[$b['color']];
            if ($colorComparison !== 0) {
                return $colorComparison;
            }
            return $valuePositions[$a['value']] <=> $valuePositions[$b['value']];
        });

        return $cards;
    }
}