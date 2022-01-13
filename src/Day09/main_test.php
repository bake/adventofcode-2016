<?php

namespace Bake\AdventOfCode2015\Day09;

require __DIR__ . '/main.php';

test('day 9 part 1 sample ADVENT', function (): void {
  expect(part1('ADVENT'))->toBe(6);
})->group('day09', 'sample');

test('day 9 part 1 sample A(1x5)BC', function (): void {
  expect(part1('A(1x5)BC'))->toBe(7);
})->group('day09', 'sample');

test('day 9 part 1 sample (3x3)XYZ', function (): void {
  expect(part1('(3x3)XYZ'))->toBe(9);
})->group('day09', 'sample');

test('day 9 part 1 sample A(2x2)BCD(2x2)EFG', function (): void {
  expect(part1('A(2x2)BCD(2x2)EFG'))->toBe(11);
})->group('day09', 'sample');

test('day 9 part 1 sample (6x1)(1x3)A', function (): void {
  expect(part1('(6x1)(1x3)A'))->toBe(6);
})->group('day09', 'sample');

test('day 9 part 1 sample X(8x2)(3x3)ABCY', function (): void {
  expect(part1('X(8x2)(3x3)ABCY'))->toBe(18);
})->group('day09', 'sample');

test('day 9 part 2 sample (3x3)XYZ', function (): void {
  expect(part2('(3x3)XYZ'))->toBe(9);
})->group('day09', 'sample');

test('day 9 part 2 sample X(8x2)(3x3)ABCY', function (): void {
  expect(part2('X(8x2)(3x3)ABCY'))->toBe(20);
})->group('day09', 'sample');

test('day 9 part 2 sample (27x12)(20x12)(13x14)(7x10)(1x12)A', function (): void {
  expect(part2('(27x12)(20x12)(13x14)(7x10)(1x12)A'))->toBe(241920);
})->group('day09', 'sample');

test('day 9 part 2 sample (25x3)(3x3)ABC(2x3)XY(5x2)PQRSTX(18x9)(3x2)TWO(5x7)SEVEN', function (): void {
  expect(part2('(25x3)(3x3)ABC(2x3)XY(5x2)PQRSTX(18x9)(3x2)TWO(5x7)SEVEN'))->toBe(445);
})->group('day09', 'sample');

test('day 9 input', function (): void {
  ini_set('memory_limit', -1);
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $string = input($handle);
  expect(part1($string))->toBe(138735);
  expect(part2($string))->toBe(11125026826);
})->group('day09', 'input');
