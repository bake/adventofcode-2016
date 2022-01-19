<?php

namespace Bake\AdventOfCode2015\Day12;

require __DIR__ . '/main.php';

test('day 12 sample', function (): void {
  $handle = string_to_stream(<<<PLAIN
  cpy 41 a
  inc a
  inc a
  dec a
  jnz a 2
  dec a
  PLAIN);
  $program = input($handle);
  expect(part1(clone $program))->toBe(42);
})->group('day12', 'sample');

test('day 12 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $program = input($handle);
  expect(part1(clone $program))->toBe(318083);
  expect(part2(clone $program))->toBe(9227737);
})->group('day12', 'input');
