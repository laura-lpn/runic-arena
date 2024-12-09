<?php

namespace App\Twig\Components;

use App\Entity\Card as CardEntity;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Card
{
  public CardEntity $card;
  public string $type;
  public string $class;

  function getIconType(): string
  {
    $iconName = $this->type . 'Icon';

    return $iconName;
  }

  function getIconClass(): string
  {
    $iconName = $this->class . 'Icon';

    return $iconName;
  }
}
