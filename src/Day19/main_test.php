<?php

namespace Bake\AdventOfCode2016\Day19;

require __DIR__ . '/main.php';

test('day 19 sample', function (): void {
  expect(part1(5))->toBe(3);
  expect(part2(5))->toBe(2);
})->group('day19', 'sample');

test('day 19 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $n = input($handle);
  expect(part1($n))->toBe(1830117);
  expect(part2($n))->toBe(1417887);
})->group('day19', 'input');
