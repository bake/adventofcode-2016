<?php

namespace Bake\AdventOfCode2016\Day25;

require __DIR__ . '/main.php';

test('day 25 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $program = input($handle);
  expect(part1(clone $program))->toBe(158);
})->group('day25', 'input');
