<?php

namespace Bake\AdventOfCode2016\Day17;

require __DIR__ . '/main.php';

test('day 17 part 1 sample', function (): void {
  expect(part1('ihgpwlah'))->toBe('DDRRRD');
  expect(part1('kglvqrro'))->toBe('DDUDRLRRUDRD');
  expect(part1('ulqzkmiv'))->toBe('DRURDRUDDLLDLUURRDULRLDUUDDDRR');
})->group('day17', 'sample');

test('day 17 part 2 sample', function (): void {
  expect(part2('ihgpwlah'))->toBe(370);
  expect(part2('kglvqrro'))->toBe(492);
  expect(part2('ulqzkmiv'))->toBe(830);
})->group('day17', 'sample');

test('day 17 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $input = input($handle);
  expect(part1($input))->toBe('DUDRLRRDDR');
  expect(part2($input))->toBe(788);
})->group('day17', 'input');
