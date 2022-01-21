<?php

namespace Bake\AdventOfCode2015\Day15;

require __DIR__ . '/main.php';

test('day 15 sample', function (): void {
  $handle = string_to_stream(<<<PLAIN
  Disc #1 has 5 positions; at time=0, it is at position 4.
  Disc #2 has 2 positions; at time=0, it is at position 1.
  PLAIN);
  $discs = input($handle);
  expect(part1($discs))->toBe(5);
})->group('day15', 'sample');

test('day 15 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $discs = input($handle);
  expect(part1($discs))->toBe(400589);
  expect(part2($discs))->toBe(3045959);
})->group('day15', 'input');
