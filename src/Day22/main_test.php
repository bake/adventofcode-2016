<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day22;

require __DIR__ . '/main.php';

test('day 22 sample', function (): void {
  $handle = string_to_stream(<<<PLAIN
  Filesystem            Size  Used  Avail  Use%
  /dev/grid/node-x0-y0   10T    8T     2T   80%
  /dev/grid/node-x0-y1   11T    6T     5T   54%
  /dev/grid/node-x0-y2   32T   28T     4T   87%
  /dev/grid/node-x1-y0    9T    7T     2T   77%
  /dev/grid/node-x1-y1    8T    0T     8T    0%
  /dev/grid/node-x1-y2   11T    7T     4T   63%
  /dev/grid/node-x2-y0   10T    6T     4T   60%
  /dev/grid/node-x2-y1    9T    8T     1T   88%
  /dev/grid/node-x2-y2    9T    6T     3T   66%
  PLAIN);
  $grid = input($handle);
  expect(part2($grid))->toBe(7);
});

test('day 22 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $grid = input($handle);
  expect(part1($grid))->toBe(1003);
  expect(part2($grid))->toBe(192);
})->group('day22', 'input');
