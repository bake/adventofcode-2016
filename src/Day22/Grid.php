<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day22;

use Iterator;

class Grid
{
  /** @var Node[][] */
  private array $grid = [];

  public function add(int $x, int $y, Node $node): void
  {
    $this->grid[$y][$x] = $node;
  }

  /** @return Iterator<Node> */
  public function each(): Iterator
  {
    foreach ($this->grid as $y => $row) {
      foreach ($row as $x => $node) {
        yield new Point($x, $y) => $node;
      }
    }
  }

  public function min(): Point
  {
    $min = new Point(PHP_INT_MAX, PHP_INT_MAX);
    foreach ($this->each() as $p => $_) {
      $min = new Point(min($min->x, $p->x), min($min->y, $p->y));
    }
    return $min;
  }

  public function max(): Point
  {
    $max = new Point(PHP_INT_MIN, PHP_INT_MIN);
    foreach ($this->each() as $p => $_) {
      $max = new Point(max($max->x, $p->x), max($max->y, $p->y));
    }
    return $max;
  }

  public function at(Point $p): ?Node
  {
    return $this->grid[$p->y][$p->x] ?? null;
  }

  /** @return Point[] */
  public function neighbours(Point $p): array
  {
    $t = $this->threshold();
    $ds = [
      new Point(0, -1), new Point(0, 1),
      new Point(-1, 0), new Point(1, 0),
    ];
    $ps = array_map(fn (Point $d): Point => $p->add($d), $ds);
    $ps = array_filter($ps, function (Point $p) use ($t): bool {
      $n = $this->at($p);
      return $n !== null && $n->used < $t;
    });
    return $ps;
  }

  public function threshold(): int
  {
    return $this->each()->current()->size;
  }

  public function __toString(): string
  {
    $out = '';
    $threshold = $this->threshold();
    foreach ($this->grid as $row) {
      foreach ($row as $node) {
        $out .= match (true) {
          $node->used === 0 => '_',
          $node->used > $threshold => '#',
          default => '.',
        };
      }
      $out .= PHP_EOL;
    }
    return $out;
  }
}
