<?php

namespace Bake\AdventOfCode2015\Day05;

function input($handle): string
{
  return trim(stream_get_contents($handle));
}

function part1(string $id): string
{
  [$size, $offset] = [8, 5];
  $password = '';
  for ($i = 0; strlen($password) < $size; $i++) {
    $hash = md5($id . $i);
    if (substr($hash, 0, $offset) !== str_repeat('0', $offset)) continue;
    $password .= $hash[$offset];
  }
  return $password;
}

function part2(string $id): string
{
  [$size, $offset] = [8, 5];
  $password = [];
  for ($i = 0; count($password) < $size; $i++) {
    $hash = md5($id . $i);
    if (substr($hash, 0, $offset) !== str_repeat('0', $offset)) continue;
    [$position, $value] = [$hash[$offset], $hash[$offset + 1]];
    if (!is_numeric($position)) continue;
    if ((int) $position >= $size) continue;
    $password[(int) $position] ??= $value;
  }
  ksort($password);
  return implode($password);
}
