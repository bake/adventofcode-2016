<?php

namespace Bake\AdventOfCode2016\Day01;

require __DIR__ . '/main.php';

test('day 1 part 1 R2, L3', function (): void {
  $handle = string_to_stream(<<<PLAIN
  R2, L3
  PLAIN);
  expect(part1(input($handle)))->toBe(5);
})->group('day01', 'sample');

test('day 1 part 1 R2, R2, R2', function (): void {
  $handle = string_to_stream(<<<PLAIN
  R2, R2, R2
  PLAIN);
  expect(part1(input($handle)))->toBe(2);
})->group('day01', 'sample');

test('day 1 part 1 R5, L5, R5, R3', function (): void {
  $handle = string_to_stream(<<<PLAIN
  R5, L5, R5, R3
  PLAIN);
  expect(part1(input($handle)))->toBe(12);
})->group('day01', 'sample');

test('day 1 part 2 R8, R4, R4, R8', function (): void {
  $handle = string_to_stream(<<<PLAIN
  R8, R4, R4, R8
  PLAIN);
  expect(part2(input($handle)))->toBe(4);
})->group('day01', 'sample');

test('day 1 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $instructions = input($handle);
  expect(part1($instructions))->toBe(181);
  expect(part2($instructions))->toBe(140);
})->group('day01', 'input');
