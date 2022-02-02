<?php

namespace Bake\AdventOfCode2016\Day24;

require __DIR__ . '/main.php';

test('day 24 sample part 1', function (): void {
  $handle = string_to_stream(<<<PLAIN
  ###########
  #0.1.....2#
  #.#######.#
  #4.......3#
  ###########
  PLAIN);
  $grid = input($handle);
  expect(part1(clone $grid))->toBe(14);
})->group('day24', 'sample');

test('day 24 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $grid = input($handle);
  expect(part1(clone $grid))->toBe(470);
  expect(part2(clone $grid))->toBe(720);
})->group('day24', 'input');
