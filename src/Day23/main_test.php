<?php

namespace Bake\AdventOfCode2016\Day23;

require __DIR__ . '/main.php';

test('day 23 sample part 1', function (): void {
  $handle = string_to_stream(<<<PLAIN
   cpy 2 a
   tgl a
   tgl a
   tgl a
   cpy 1 a
   dec a
   dec a
   PLAIN);
  $program = input($handle);
  expect(part1(clone $program))->toBe(3);
})->group('day23', 'sample');

test('day 23 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $program = input($handle);
  expect(part1(clone $program))->toBe(10_890);
  expect(part2(clone $program))->toBe(479_007_450);
})->group('day23', 'input');
