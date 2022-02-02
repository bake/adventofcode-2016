<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day24;

use Ds\Map;
use Ds\Queue;
use Ds\Set;

function input($handle): Grid
{
  return new Grid(stream_get_contents($handle));
}

function bfs(Grid $grid, Point $src, Point $dst)
{
  static $cache;
  if (isset($cache["{$src},{$dst}"])) return $cache["{$src},{$dst}"];
  $queue = new Queue([$src]);
  $distances = new Map(["{$src}" => 0]);
  $visited = new Set([]);
  while (!$queue->isEmpty()) {
    /** @var Point */
    $p = $queue->pop();
    if ("{$p}" === "{$dst}") break;
    if ($visited->contains("{$p}")) continue;
    $visited->add("{$p}");
    $d = $distances->get("{$p}");
    foreach ($grid->neighbours($p) as $q) {
      $distances->put("{$q}", $d + 1);
      $queue->push($q);
    }
  }
  return $cache["{$src},{$dst}"] = $distances->get("{$dst}");
}

function permutations(array $array): iterable
{
  if (empty($array)) return yield $array;
  foreach ($array as $i => $value) {
    $new = [
      ...array_slice($array, 0, $i),
      ...array_slice($array, $i + 1),
    ];
    foreach (permutations($new) as $perm) {
      yield [$value, ...$perm];
    }
  }
}

function part1(Grid $grid): int
{
  $locations = $grid->locations();
  $head = array_shift($locations);
  $min = PHP_INT_MAX;
  foreach (permutations($locations) as $perm) {
    $perm = [$head, ...$perm];
    $sum = 0;
    for ($i = 1; $i < count($perm); $i++) {
      $sum += bfs($grid, $perm[$i - 1], $perm[$i]);
    }
    $min = min($min, $sum);
  }
  return $min;
}

function part2(Grid $grid): int
{
  $locations = $grid->locations();
  $head = array_shift($locations);
  $min = PHP_INT_MAX;
  foreach (permutations($locations) as $perm) {
    $perm = [$head, ...$perm, $head];
    $sum = 0;
    for ($i = 1; $i < count($perm); $i++) {
      $sum += bfs($grid, $perm[$i - 1], $perm[$i]);
    }
    $min = min($min, $sum);
  }
  return $min;
}
