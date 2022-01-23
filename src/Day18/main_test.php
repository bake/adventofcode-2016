<?php

namespace Bake\AdventOfCode2016\Day18;

require __DIR__ . '/main.php';

test('day 18 sample', function (): void {
  expect(part1('.^^.^.^^^^', 10))->toBe(38);
})->group('day18', 'sample');

test('day 18 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $row = input($handle);
  expect(part1($row))->toBe(1_963);
  expect(part2($row))->toBe(20_009_568);
})->group('day18', 'input');
