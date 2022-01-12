<?php

namespace Bake\AdventOfCode2015\Day03;

require __DIR__ . '/main.php';

test('day 3 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $nums = [...input($handle)];
  expect(part1($nums))->toBe(862);
  expect(part2($nums))->toBe(1577);
})->group('day03', 'input');
