<?php

namespace Bake\AdventOfCode2015\Day08;

require __DIR__ . '/main.php';

test('day 8 sample', function (): void {
  $handle = string_to_stream(<<<PLAIN
  rect 3x2
  rotate column x=1 by 1
  rotate row y=0 by 4
  rotate column x=1 by 1
  PLAIN);
  $instructions = [...input($handle)];
  $screen = screen(7, 3, $instructions);
  expect(voltage($screen))->toBe(6);
  expect(print_screen($screen))->toBe(<<<PLAIN
  .#..#.#
  #.#....
  .#.....
  PLAIN);
})->group('day08', 'sample');

test('day 8 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $instructions = [...input($handle)];
  expect(part1($instructions))->toBe(116);
  expect(part2($instructions))->toBe(<<<PLAIN
  #..#.###...##....##.####.#....###...##..####.####.
  #..#.#..#.#..#....#.#....#....#..#.#..#.#.......#.
  #..#.#..#.#..#....#.###..#....###..#....###....#..
  #..#.###..#..#....#.#....#....#..#.#....#.....#...
  #..#.#....#..#.#..#.#....#....#..#.#..#.#....#....
  .##..#.....##...##..#....####.###...##..####.####.
  PLAIN);
})->group('day08', 'input');
