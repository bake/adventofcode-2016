<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day20;

require __DIR__ . '/main.php';

test('day 20 sample', function (): void {
  $handle = string_to_stream(<<<PLAIN
  5-8
  0-2
  4-7
  PLAIN);
  $ranges = input($handle);
  expect(part1($ranges))->toBe(3);
})->group('day20', 'sample');

test('day 20 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $ranges = input($handle);
  expect(part1($ranges))->toBe(17348574);
  expect(part2($ranges))->toBe(104);
})->group('day20', 'input');
