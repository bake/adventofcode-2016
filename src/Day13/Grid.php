<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2015\Day13;

class Grid
{
  public function __construct(
    private readonly int $seed,
  ) {
  }

  public function at(Point $p): Tile
  {
    if ($p->x < 0 || $p->y < 0) return Tile::Wall;
    $sum = $this->seed +
      $p->x * $p->x +
      $p->x * 3 +
      $p->x * $p->y * 2 +
      $p->y +
      $p->y * $p->y;
    $ones = substr_count(decbin($sum), '1');
    return match ($ones % 2 === 0) {
      true => Tile::Floor,
      false => Tile::Wall,
    };
  }

  /** @return iterable<Point> */
  public function neighbours(Point $p): iterable
  {
    yield $p->add(new Point(0, -1));
    yield $p->add(new Point(-1, 0));
    yield $p->add(new Point(1, 0));
    yield $p->add(new Point(0, 1));
  }

  public function print(int $width, int $height): string
  {
    $str = '';
    for ($y = 0; $y < $height; $y++) {
      for ($x = 0; $x < $width; $x++) {
        $str .= $this->at(new Point($x, $y))->string();
      }
      $str .= PHP_EOL;
    }
    return $str;
  }
}
