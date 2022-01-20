<?php

namespace Bake\AdventOfCode2015\Day13;

require __DIR__ . '/main.php';

test('day 13 sample', function (): void {
  expect(part1(new Grid(10), dst: new Point(7, 4)))->toBe(11);
})->group('day13', 'sample');

test('day 13 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $grid = input($handle);
  expect(part1(clone $grid))->toBe(90);
  expect(part2(clone $grid))->toBe(135);
})->group('day13', 'input');
