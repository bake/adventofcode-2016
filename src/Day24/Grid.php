<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day24;

use Iterator;
use PhpParser\Node\Stmt\Continue_;

class Grid
{
  /** @var string[][] */
  private readonly array $grid;

  public function __construct(string $grid)
  {
    $grid = explode(PHP_EOL, $grid);
    $grid = array_filter($grid);
    $grid = array_map(str_split(...), $grid);
    $this->grid = $grid;
  }

  /** @return Iterator<Node> */
  public function each(): Iterator
  {
    foreach ($this->grid as $y => $row) {
      foreach ($row as $x => $value) {
        yield new Point($x, $y) => $value;
      }
    }
  }

  public function at(Point $p): string
  {
    return $this->grid[$p->y][$p->x] ?? '#';
  }

  /** @return Iterator<Point> */
  public function neighbours(Point $p): Iterator
  {
    $ds = [
      new Point(0, -1), new Point(0, 1),
      new Point(-1, 0), new Point(1, 0),
    ];
    foreach ($ds as $d) {
      $q = $p->add($d);
      $v = $this->at($q);
      if ($v === '#') continue;
      yield $q;
    }
  }

  /** @return array<Int,Point> */
  public function locations(): array
  {
    $locations = [];
    foreach ($this->each() as $p => $v) {
      if (!is_numeric($v)) continue;
      $locations[(int) $v] = $p;
    }
    ksort($locations);
    return $locations;
  }
}
