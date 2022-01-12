<?php

namespace Bake\AdventOfCode2015\Day03;

function input($handle): iterable
{
  while ($nums = fscanf($handle, '%d %d %d')) {
    yield array_map(intval(...), $nums);
  }
}

function possible(array $nums): bool
{
  [$a, $b, $c] = $nums;
  return $a + $b > $c && $a + $c > $b && $b + $c > $a;
}

function part1(array $nums): int
{
  return count(array_filter($nums, possible(...)));
}

function part2(array $nums): int
{
  return part1(array_chunk([
    ...array_column($nums, 0),
    ...array_column($nums, 1),
    ...array_column($nums, 2),
  ], 3));
}
