<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day16;

function input($handle): string
{
  return trim(stream_get_contents($handle));
}

function str_not(string $input): string
{
  $output = '';
  for ($i = 0; $i < strlen($input); $i++) {
    $output .= match ($input[$i]) {
      '0' => '1',
      '1' => '0',
    };
  }
  return $output;
}

function dragon_curve(string $input, int $length): string
{
  $output = $input;
  do {
    $output = $output . '0' . str_not(strrev($output));
  } while (strlen($output) < $length);
  return substr($output, 0, $length);
}

function checksum(string $input): string
{
  do {
    $output = '';
    for ($i = 0; $i < strlen($input) - 1; $i += 2) {
      $output .= match (substr($input, $i, 2)) {
        '00', '11' => '1',
        '01', '10' => '0',
      };
    }
    $input = $output;
  } while (strlen($output) % 2 === 0);
  return $output;
}

function part1(string $input, int $length = 272): string
{
  return checksum(dragon_curve($input, $length));
}

function part2(string $input): string
{
  return part1($input, 35_651_584);
}
