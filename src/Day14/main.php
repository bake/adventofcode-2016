<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day14;

function input($handle): string
{
  return trim(stream_get_contents($handle));
}

/**
 * Get the first character that occures $size times in a row.
 */
function str_contains_sequence(string $haystack, int $size): ?string
{
  for ($i = 0; $i < strlen($haystack); $i++) {
    if (substr($haystack, $i, $size) === str_repeat($haystack[$i], $size)) {
      return $haystack[$i];
    }
  }
  return null;
}

function next_hash(
  string $salt,
  string $needle,
  int $min,
  int $max,
  callable $hash_fn,
): ?int {
  for ($i = $min; $i < $max; $i++) {
    $hash = $hash_fn("{$salt}{$i}");
    if (str_contains($hash, $needle)) {
      return $i;
    }
  }
  return null;
}

function hash(string $string, int $num = 1): string
{
  static $cache;
  if (isset($cache["$string,$num"])) return $cache["$string,$num"];
  $hash = $string;
  for ($i = 0; $i < $num; $i++) {
    $hash = md5($hash);
  }
  return $cache["$string,$num"] = $hash;
}

function repeat(string $char, int $n): string
{
  static $cache;
  if (isset($cache["$char,$n"])) return $cache["$char,$n"];
  return $cache["$char,$n"] = str_repeat($char, $n);
}

/** @return iterable<int> */
function keys(string $salt, int $num, callable $hash_fn): iterable
{
  $found = 0;
  for ($i = 0; $found < $num; $i++) {
    $hash = $hash_fn("{$salt}{$i}");
    $char = str_contains_sequence($hash, 3);
    if ($char === null) continue;
    $j = next_hash($salt, repeat($char, 5), $i + 1, $i + 1001, $hash_fn);
    if ($j === null) continue;
    yield $i;
    $found++;
  }
}

function part1(string $salt, int $keys = 64): int
{
  $is = [...keys($salt, $keys, hash(...))];
  return end($is);
}

function part2(string $salt, int $keys = 64, int $n = 2017): int
{
  $fn = fn (string $string): string => hash($string, $n);
  $is = [...keys($salt, $keys, $fn)];
  return end($is);
}
