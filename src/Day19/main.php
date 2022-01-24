<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day19;

function input($handle): int
{
  return (int) trim(stream_get_contents($handle));
}

function josephus(int $n): int
{
  $l = $n - (int) pow(2, (int) log($n, 2));
  return 2 * $l + 1;
}

function part1(int $n): int
{
  return josephus($n);
}

function part2(int $n): int
{
  $elf = 1;
  for ($i = 1; $i < $n; $i++) {
    $elf %= $i;
    $elf += 1;
    if ($elf > ($i + 1) / 2) $elf++;
  }
  return $elf;
}
