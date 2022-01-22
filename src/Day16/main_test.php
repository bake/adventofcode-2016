<?php

namespace Bake\AdventOfCode2015\Day16;

require __DIR__ . '/main.php';

test('day 16 dragon_curve', function (): void {
  expect(dragon_curve('10000', 20))->toBe('10000011110010000111');
})->group('day16', 'sample');

test('day 16 checksum', function (): void {
  expect(checksum('110010110100'))->toBe('100');
})->group('day16', 'sample');

test('day 16 sample', function (): void {
  $handle = string_to_stream(<<<PLAIN
  10000
  PLAIN);
  $input = input($handle);
  expect(part1($input, 20))->toBe('01100');
})->group('day16', 'input');

test('day 16 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $input = input($handle);
  expect(part1($input))->toBe('10101001010100001');
  expect(part2($input))->toBe('10100001110101001');
})->group('day16', 'input');
