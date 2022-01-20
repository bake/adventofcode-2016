<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2015\Day13;

enum Tile
{
  case Floor;
  case Wall;

  public function string(): string
  {
    return match ($this) {
      self::Floor => '.',
      self::Wall => '#',
    };
  }
}
