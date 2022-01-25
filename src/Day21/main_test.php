<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day21;

require __DIR__ . '/main.php';

test('day 21 test swap position', function (): void {
  expect(swap_position('abcde', 4, 0))->toBe('ebcda');
})->group('day21', 'sample');

test('day 21 test swap letter', function (): void {
  expect(swap_letter('ebcda', 'd', 'b'))->toBe('edcba');
})->group('day21', 'sample');

test('day 21 test reverse', function (): void {
  expect(reverse_position('edcba', 0, 4))->toBe('abcde');
})->group('day21', 'sample');

test('day 21 test rotate left', function (): void {
  expect(rotate_left('abcde', 1))->toBe('bcdea');
  expect(rotate_left('abcde', 2))->toBe('cdeab');
  expect(rotate_left('abcde', 3))->toBe('deabc');
})->group('day21', 'sample');

test('day 21 test rotate right', function (): void {
  expect(rotate_right('abcde', 1))->toBe('eabcd');
  expect(rotate_right('abcde', 2))->toBe('deabc');
  expect(rotate_right('abcde', 3))->toBe('cdeab');
})->group('day21', 'sample');

test('day 21 test move position', function (): void {
  expect(move_position('bcdea', 1, 4))->toBe('bdeac');
  expect(move_position('bdeac', 3, 0))->toBe('abdec');
})->group('day21', 'sample');

test('day 21 test rotate letter', function (): void {
  expect(rotate_letter('abdec', 'b'))->toBe('ecabd');
  expect(rotate_letter('ecabd', 'd'))->toBe('decab');
  expect(rotate_letter('cdefghab', 'f'))->toBe('ghabcdef');
})->group('day21', 'sample');

test('day 21 part 1 sample', function (): void {
  $handle = string_to_stream(<<<PLAIN
  swap position 4 with position 0
  swap letter d with letter b
  reverse positions 0 through 4
  rotate left 1 step
  move position 1 to position 4
  move position 3 to position 0
  rotate based on position of letter b
  rotate based on position of letter d
  PLAIN);
  $instructions = [...input($handle)];
  expect(part1('abcde', $instructions))->toBe('decab');
})->group('day21', 'sample');

test('day 21 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $instructions = [...input($handle)];
  expect(part1('abcdefgh', $instructions))->toBe('gbhafcde');
  expect(part2('fbgdceah', $instructions))->toBe('bcfaegdh');
})->group('day21', 'input');
