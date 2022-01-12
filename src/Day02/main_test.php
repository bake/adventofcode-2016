<?php

namespace Bake\AdventOfCode2015\Day02;

require __DIR__ . '/main.php';

test('day 1 sample', function (): void {
  $handle = string_to_stream(<<<PLAIN
  ULL
  RRDDD
  LURDL
  UUUUD  
  PLAIN);
  $instructions = [...input($handle)];
  expect(part1($instructions))->toBe('1985');
  expect(part2($instructions))->toBe('5DB3');
})->group('day02', 'sample');

test('day 1 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $instructions = [...input($handle)];
  expect(part1($instructions))->toBe('76792');
  expect(part2($instructions))->toBe('A7AC3');
})->group('day02', 'input');
