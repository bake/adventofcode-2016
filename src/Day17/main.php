<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day17;

use Iterator;
use SplQueue;

function input($handle): string
{
  return trim(stream_get_contents($handle));
}

function doors(string $hash): array
{
  $doors = [
    new Point(0, -1),
    new Point(0, 1),
    new Point(-1, 0),
    new Point(1, 0),
  ];
  $chars = str_split($hash);
  $doors = array_map(fn (Point $door, string $char): ?Point => match ($char) {
    'b', 'c', 'd', 'e', 'f' => $door,
    default => null,
  }, $doors, $chars);
  $doors = array_combine(['U', 'D', 'L', 'R'], $doors);
  $doors = array_filter($doors);
  return $doors;
}

function bfs(string $passcode, Path $src, Point $dst): Iterator
{
  $path = '';
  $queue = new SplQueue;
  $queue->enqueue($src);
  $distances = ["{$src->position}" => ''];
  while (!$queue->isEmpty()) {
    /** @var Path */
    $path = $queue->dequeue();
    if ("{$path->position}" === "{$dst}") {
      yield $distances["{$dst}"];
      continue;
    }
    $deltas = doors(substr(md5("{$passcode}{$path}"), 0, 4));
    foreach ($deltas as $direction => $delta) {
      $position = $path->position->add($delta);
      if ($position->x < 0 || $position->x >= 4) continue;
      if ($position->y < 0 || $position->y >= 4) continue;
      $new = new Path($position, "{$path}{$direction}");
      $distances["{$position}"] = "{$path}{$direction}";
      $queue->enqueue($new);
    }
  }
}

function part1(string $passcode): string
{
  $distances = bfs($passcode, new Path(new Point(0, 0), ''), new Point(3, 3));
  return $distances->current();
}

function part2(string $passcode): int
{
  $distances = bfs($passcode, new Path(new Point(0, 0), ''), new Point(3, 3));
  $distances = [...$distances];
  return strlen(end($distances));
}
