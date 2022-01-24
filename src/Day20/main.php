<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day20;

/** @return Range[] */
function input($handle): array
{
  $ranges = explode(PHP_EOL, stream_get_contents($handle));
  $ranges = array_filter($ranges);
  $ranges = array_map(Range::from(...), $ranges);
  usort($ranges, fn (Range $a, Range $b): int => $a->max <=> $b->max);
  usort($ranges, fn (Range $a, Range $b): int => $a->min <=> $b->min);
  return $ranges;
}

/** @param Range[] */
function part1(array $ranges): int
{
  $min = 0;
  foreach ($ranges as $r) {
    if ($r->min > $min) break;
    if ($r->max >= $min) $min = $r->max + 1;
  }
  return $min;
}

/** @param Range[] */
function part2(array $ranges): int
{
  $max = $num = 0;
  foreach ($ranges as $r) {
    if ($r->min > $max) $num += $r->min - $max;
    if ($r->max >= $max) $max = $r->max + 1;
  }
  return $num;
}
