<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day13;

use SplQueue;

function input($handle): Grid
{
  return new Grid((int) trim(stream_get_contents($handle)));
}

function part1(
  Grid $grid,
  Point $src = new Point(1, 1),
  Point $dst = new Point(31, 39),
): int {
  $queue = new SplQueue;
  $queue->enqueue($src);
  $distances = ["$src" => 0];
  while (!$queue->isEmpty()) {
    /** @var Point */
    $p = $queue->dequeue();
    $d = $distances["$p"];
    foreach ($grid->neighbours($p) as $q) {
      if (isset($distances["$q"])) continue;
      if ($grid->at($q) === Tile::Wall) continue;
      $distances["$q"] = $d + 1;
      $queue->enqueue($q);
      if ("$q" === "$dst") break 2;
    }
  }
  return $distances["$dst"];
}

function part2(Grid $grid, Point $src = new Point(1, 1)): int
{
  $queue = new SplQueue;
  $queue->enqueue($src);
  $distances = ["$src" => 0];
  while (!$queue->isEmpty()) {
    /** @var Point */
    $p = $queue->dequeue();
    $d = $distances["$p"];
    foreach ($grid->neighbours($p) as $q) {
      if (isset($distances["$q"])) continue;
      if ($grid->at($q) === Tile::Wall) continue;
      $distances["$q"] = $d + 1;
      $queue->enqueue($q);
    }
  }
  return count(array_filter($distances, fn (int $d): bool => $d <= 50));
}
