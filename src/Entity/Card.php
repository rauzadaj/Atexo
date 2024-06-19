<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardRepository::class)]
class Card implements \JsonSerializable
{

    private string $color;
    private string $value;
    public function __construct(string $color, string $value)
    {
        $this->color = $color;
        $this->value = $value;
    }
    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value . ' de ' . $this->color;
    }
    public function jsonSerialize(): array
    {
        return [
            'color' => $this->color,
            'value' => $this->value,
        ];
    }
}
