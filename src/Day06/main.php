<?php

namespace Bake\AdventOfCode2016\Day06;

function input($handle): array
{
  $messages = explode(PHP_EOL, stream_get_contents($handle));
  $messages = array_filter($messages);
  $messages = array_map(str_split(...), $messages);
  return $messages;
}

function part1(array $messages): string
{
  $message = '';
  foreach (array_keys(reset($messages)) as $i) {
    $column = array_column($messages, $i);
    $column = array_count_values($column);
    arsort($column);
    $message .= key($column);
  }
  return $message;
}

function part2(array $messages): string
{
  $message = '';
  foreach (array_keys(reset($messages)) as $i) {
    $column = array_column($messages, $i);
    $column = array_count_values($column);
    asort($column);
    $message .= key($column);
  }
  return $message;
}
