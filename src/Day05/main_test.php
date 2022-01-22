<?php

namespace Bake\AdventOfCode2016\Day05;

require __DIR__ . '/main.php';

test('day 5 part 1 sample', function (): void {
  expect(part1('abc'))->toBe('18f47a30');
})->group('day05', 'sample');

test('day 5 part 2 sample', function (): void {
  expect(part2('abc'))->toBe('05ace8e3');
})->group('day05', 'sample');

test('day 5 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $id = input($handle);
  expect(part1($id))->toBe('d4cd2ee1');
  expect(part2($id))->toBe('f2c730e5');
})->group('day05', 'input');
