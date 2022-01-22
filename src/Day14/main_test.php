<?php

namespace Bake\AdventOfCode2016\Day14;

require __DIR__ . '/main.php';

test('day 14 sample', function (): void {
  expect(part1('abc'))->toBe(22728);
  expect(part2('abc'))->toBe(22551);
})->group('day14', 'sample');

test('day 14 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $salt = input($handle);
  expect(part1($salt))->toBe(15035);
  expect(part2($salt))->toBe(19968);
})->group('day14', 'input');
