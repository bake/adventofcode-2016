<?php

namespace Bake\AdventOfCode2016\Day06;

require __DIR__ . '/main.php';

test('day 6 sample', function (): void {
  $handle = string_to_stream(<<<PLAIN
  eedadn
  drvtee
  eandsr
  raavrd
  atevrs
  tsrnev
  sdttsa
  rasrtv
  nssdts
  ntnada
  svetve
  tesnvt
  vntsnd
  vrdear
  dvrsen
  enarar
  PLAIN);
  $messages = input($handle);
  expect(part1($messages))->toBe('easter');
  expect(part2($messages))->toBe('advent');
})->group('day06', 'sample');

test('day 6 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $messages = [...input($handle)];
  expect(part1($messages))->toBe('qoclwvah');
  expect(part2($messages))->toBe('ryrgviuv');
})->group('day06', 'input');
