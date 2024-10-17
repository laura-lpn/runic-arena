<?php

namespace App\Service;

class GenerateName
{
  public function generateName()
  {
    $techno = ['Laravel', 'Symfony', 'React', 'Angular', 'Vue', 'Django', 'Ruby', 'Express', 'Svelte', 'Nest', 'Nuxt', 'Bun', 'Node', 'Deno', 'Tailwind', 'Pico'];

    $class = ['Maître', 'Elfe', 'Nain', 'Prêtre', 'Voleur', 'Paladin', 'Druide', 'Chaman', 'Démoniste', 'Sorcier', 'Ninja', 'Samouraï', 'Rôdeur', 'Bretteur', 'Lancier', 'Oracle'];

    $nameRandom = $class[array_rand($class)] . ' ' . $techno[array_rand($techno)];

    return $nameRandom;
  }
}
