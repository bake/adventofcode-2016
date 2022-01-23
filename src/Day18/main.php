<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day18;

function input($handle): string
{
  return trim(stream_get_contents($handle));
}

function next(string $row): string
{
  $row = ".{$row}.";
  $out = '';
  for ($i = 1; $i < strlen($row) - 1; $i++) {
    $out .= match (substr($row, $i - 1, 3)) {
      '^^.' => '^',
      '.^^' => '^',
      '^..' => '^',
      '..^' => '^',
      default => '.',
    };
  }
  return $out;
}

function part1(string $row, int $n = 40): int
{
  $sum = 0;
  for ($i = 0; $i < $n; $i++) {
    $sum += substr_count($row, '.');
    $row = next($row);
  }
  return $sum;
}

function part2(string $row): int
{
  return part1($row, 400_000);
}
