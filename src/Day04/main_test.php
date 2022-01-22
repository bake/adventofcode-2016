<?php

namespace Bake\AdventOfCode2016\Day04;

require __DIR__ . '/main.php';

test('day 4 validate aaaaa-bbb-z-y-x-123[abxyz]', function (): void {
  $room = new Room('aaaaa-bbb-z-y-x', 123, 'abxyz');
  expect($room->validate())->toBeTrue();
})->group('day04', 'sample');

test('day 4 validate a-b-c-d-e-f-g-h-987[abcde]', function (): void {
  $room = new Room('a-b-c-d-e-f-g-h', 987, 'abcde');
  expect($room->validate())->toBeTrue();
})->group('day04', 'sample');

test('day 4 validate not-a-real-room-404[oarel]', function (): void {
  $room = new Room('not-a-real-room', 404, 'oarel');
  expect($room->validate())->toBeTrue();
})->group('day04', 'sample');

test('day 4 validate totally-real-room-200[decoy]', function (): void {
  $room = new Room('totally-real-room', 200, 'decoy');
  expect($room->validate())->toBeFalse();
})->group('day04', 'sample');

test('day 4 decrypt qzmt-zixmtkozy-ivhz-343', function (): void {
  $room = new Room('qzmt-zixmtkozy-ivhz', 343, '');
  expect($room->decrypt())->toBe('very encrypted name');
})->group('day04', 'sample');

test('day 4 input', function (): void {
  $handle = fopen(__DIR__ . '/input.txt', 'r');
  $rooms = [...input($handle)];
  expect(part1($rooms))->toBe(245102);
  expect(part2($rooms))->toBe(324);
})->group('day04', 'input');
