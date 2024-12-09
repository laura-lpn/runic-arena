<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class SoigneurIcon
{
  public string $color;
  public string $width;
  public string $height;
}
