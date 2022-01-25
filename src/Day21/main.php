<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day21;

function input($handle): iterable
{
  while ($ins = fgets($handle)) yield match (1) {
    preg_match('/^swap position (\d+) with position (\d+)$/', $ins, $vals) => fn (string $string): string => swap_position($string, (int) $vals[1], (int) $vals[2]),
    preg_match('/^swap letter (\w+) with letter (\w+)$/', $ins, $vals) => fn (string $string): string => swap_letter($string, $vals[1], $vals[2]),
    preg_match('/^rotate left (\d+) steps?$/', $ins, $vals) => fn (string $string): string => rotate_left($string, (int) $vals[1]),
    preg_match('/^rotate right (\d+) steps?$/', $ins, $vals) => fn (string $string): string => rotate_right($string, (int) $vals[1]),
    preg_match('/^rotate based on position of letter (\w+)/', $ins, $vals) => fn (string $string): string => rotate_letter($string, $vals[1]),
    preg_match('/^reverse positions (\d+) through (\d+)/', $ins, $vals) => fn (string $string): string => reverse_position($string, (int) $vals[1], (int) $vals[2]),
    preg_match('/^move position (\d+) to position (\d+)/', $ins, $vals) => fn (string $string): string => move_position($string, (int) $vals[1], (int) $vals[2]),
  };
}

// swap position X with position Y
function swap_position(string $string, int $x, int $y): string
{
  [$string[$x], $string[$y]] = [$string[$y], $string[$x]];
  return $string;
}

// swap letter X with letter Y
function swap_letter(string $string, string $x, string $y): string
{
  return swap_position($string, strpos($string, $x), strpos($string, $y));
}

// rotate left X steps
function rotate_left(string $string, int $steps): string
{
  return substr($string, $steps, strlen($string) - $steps) . substr($string, 0, $steps);
}

// rotate right X steps
function rotate_right(string $string, int $steps): string
{
  return substr($string, strlen($string) - $steps) . substr($string, 0, strlen($string) - $steps);
}

// rotate based on position of letter X
function rotate_letter(string $string, string $letter): string
{
  $steps = strpos($string, $letter) + 1;
  if ($steps > 4) $steps += 1;
  return rotate_right($string, $steps);
}

// reverse positions X through Y
function reverse_position(string $string, int $x, int $y): string
{
  return substr($string, 0, $x) . strrev(substr($string, $x, $y + 1 - $x)) . substr($string, $y + 1);
}

// move position X to position Y
function move_position(string $string, int $x, int $y): string
{
  $char = $string[$x];
  $string = substr($string, 0, $x) . substr($string, $x + 1);
  $string = substr($string, 0, $y) . $char . substr($string, $y);
  return $string;
}

function part1(string $string, array $instructions): string
{
  foreach ($instructions as $instruction) {
    $string = $instruction($string);
  }
  return $string;
}

function permutations(string $string): iterable
{
  if (strlen($string) === 1) return yield $string;
  for ($i = 0; $i < strlen($string); $i++) {
    $new = substr($string, 0, $i) . substr($string, $i + 1);
    foreach (permutations($new) as $perm) {
      yield $string[$i] . $perm;
    }
  }
}

function part2(string $string, array $instructions): string
{
  // We could reverse the instructions or just be lazy.
  foreach (permutations($string) as $perm) {
    if (part1($perm, $instructions) === $string) {
      break;
    }
  }
  return $perm;
}
