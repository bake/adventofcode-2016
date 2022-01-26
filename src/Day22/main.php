<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day22;

use Ds\Map;
use Ds\Queue;
use Ds\Set;

function input($handle): Grid
{
  $grid = new Grid;
  while ($node = fgetcsv($handle, separator: ' ')) {
    if (count($node) < 4) continue;
    [$position, $size, $used, $available] = [...array_filter($node)];
    [$x, $y] = sscanf($position, '/dev/grid/node-x%d-y%d');
    if ($x === null || $y === null) continue;
    $grid->add($x, $y, new Node((int) $size, (int) $used, (int) $available));
  }
  return $grid;
}

function bfs(Grid $grid, Point $src, Point $dst)
{
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
      $distances->put("$q", $d + 1);
      $queue->push($q);
    }
  }
  return $distances->get("{$dst}");
}

function part1(Grid $grid): int
{
  $num = 0;
  foreach ($grid->each() as $a) {
    if ($a->used === 0) continue;
    foreach ($grid->each() as $b) {
      if ($a === $b) continue;
      if ($a->used > $b->available) continue;
      $num++;
    }
  }
  return $num;
}

function part2(Grid $grid): int
{
  $target = $grid->min();
  $goal = new Point($grid->max()->x, $grid->min()->y);
  $goal = $goal->add(new Point(-1, 0));
  $empty = null;
  foreach ($grid->each() as $p => $node) {
    if ($node->used === 0) {
      $empty = $p;
      break;
    }
  }
  return bfs($grid, $empty, $goal) + 5 * bfs($grid, $goal, $target) + 1;
}
