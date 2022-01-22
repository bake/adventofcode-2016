<?php

namespace Bake\AdventOfCode2016\Day07;

require __DIR__ . '/main.php';

test('day 7 part 1 sample', function (): void {
  $handle = string_to_stream(<<<PLAIN
  abba[mnop]qrst
  abcd[bddb]xyyx
  aaaa[qwer]tyui
  ioxxoj[asdfgh]zxcvbn
  PLAIN);
  $ips = [...input($handle)];
  expect(part1($ips))->toBe(2);
})->group('day07', 'sample');

test('day 7 part 2 sample', function (): void {
  $handle = string_to_stream(<<<PLAIN
  aba[bab]xyz supports
  xyx[xyx]xyx
  aaa[kek]eke
  zazbz[bzb]cdb
  PLAIN);
  $ips = [...input($handle)];
  expect(part2($ips))->toBe(3);
})->group('day07', 'sample');

test('day 7 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $ips = [...input($handle)];
  expect(part1($ips))->toBe(105);
  expect(part2($ips))->toBe(258);
})->group('day07', 'input');
