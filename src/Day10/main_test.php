<?php

namespace Bake\AdventOfCode2016\Day10;

require __DIR__ . '/main.php';

test('day 10 sample', function (): void {
  $handle = string_to_stream(<<<PLAIN
  value 5 goes to bot 2
  bot 2 gives low to bot 1 and high to bot 0
  value 3 goes to bot 1
  bot 1 gives low to output 1 and high to bot 0
  bot 0 gives low to output 2 and high to output 0
  value 2 goes to bot 2
  PLAIN);
  $input = input($handle);
  expect(part1($input->outputs, $input->bots, $input->values, 2, 5))->toBe(2);
})->group('day10', 'sample');

test('day 10 part 1 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $input = input($handle);
  expect(part1($input->outputs, $input->bots, $input->values))->toBe(93);
})->group('day10', 'input');

test('day 10 part 2 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $input = input($handle);
  expect(part2($input->outputs, $input->bots, $input->values))->toBe(47101);
})->group('day10', 'input');
