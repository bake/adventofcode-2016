<?php

namespace Bake\AdventOfCode2016\Day09;

function input($handle): string
{
  return trim(stream_get_contents($handle));
}

function decompress(string $string): string
{
  $out = '';
  while (strlen($string) > 0) {
    $left = strpos($string, '(');
    if ($left === false) {
      $out .= $string;
      break;
    }
    $right = strpos($string, ')');
    $marker = substr($string, $left + 1, $right - $left - 1);
    $marker = array_map(intval(...), explode('x', $marker));
    $out .= substr($string, 0, $left);
    $out .= str_repeat(substr($string, $right + 1, $marker[0]), $marker[1]);
    $string = substr($string, $right + 1 + $marker[0]);
  }
  return $out;
}

function decompressed_length(string $string): int
{
  $left = strpos($string, '(');
  if ($left === false) return strlen($string);
  $right = strpos($string, ')');
  $marker = substr($string, $left + 1, $right - $left - 1);
  $marker = array_map(intval(...), explode('x', $marker));
  return array_sum([
    $left,
    decompressed_length(substr($string, $right + 1, $marker[0])) * $marker[1],
    decompressed_length(substr($string, $right + 1 + $marker[0])),
  ]);
}

function part1(string $string): int
{
  return strlen(decompress($string));
}

function part2(string $string): int
{
  return decompressed_length($string);
}
