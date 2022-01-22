<?php

namespace Bake\AdventOfCode2016\Day08;

function input($handle): iterable
{
  while ($ins = fgets($handle)) {
    yield match (1) {
      preg_match('/^rect (\d+)x(\d+)$/', $ins, $vals) => fn (array $screen): array => rect($screen, $vals[1], $vals[2]),
      preg_match('/^rotate row y=(\d+) by (\d+)$/', $ins, $vals) => fn (array $screen): array => rotate_row($screen, $vals[1], $vals[2]),
      preg_match('/^rotate column x=(\d+) by (\d+)$/', $ins, $vals) => fn (array $screen): array => rotate_column($screen, $vals[1], $vals[2]),
    };
  }
}

function rect(array $screen, int $width, int $height): array
{
  $height = min($height, count($screen));
  $width = min($width, count(reset($screen)));
  for ($y = 0; $y < $height; $y++) {
    for ($x = 0; $x < $width; $x++) {
      $screen[$y][$x] = true;
    }
  }
  return $screen;
}

function rotate_row(array $screen, int $row, int $n): array
{
  $width = count(reset($screen));
  $screen[$row] = [
    ...array_slice($screen[$row], $width - $n),
    ...array_slice($screen[$row], 0, $width - $n),
  ];
  return $screen;
}

function rotate_column(array $screen, int $column, int $n): array
{
  $screen = array_map(null, ...$screen);
  $screen = rotate_row($screen, $column, $n);
  $screen = array_map(null, ...$screen);
  return $screen;
}

function print_screen(array $screen): string
{
  $str = '';
  for ($y = 0; $y < count($screen); $y++) {
    for ($x = 0; $x < count($screen[$y]); $x++) {
      $str .= $screen[$y][$x] ? '#' : '.';
    }
    $str .= PHP_EOL;
  }
  return trim($str);
}

function screen(int $width, int $height, array $instructions): array
{
  $screen = array_fill(0, $height, array_fill(0, $width, 0));
  foreach ($instructions as $ins) {
    $screen = $ins($screen);
  }
  return $screen;
}

function voltage(array $screen): int
{
  return array_sum(array_map(array_sum(...), $screen));
}

function part1(array $instructions): int
{
  return voltage(screen(50, 6, $instructions));
}

function part2(array $instructions): string
{
  $screen = screen(50, 6, $instructions);
  return print_screen($screen);
}
