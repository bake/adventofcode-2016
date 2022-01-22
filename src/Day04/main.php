<?php

namespace Bake\AdventOfCode2016\Day04;

class Room
{
  public function __construct(
    public readonly string $name,
    public readonly int $id,
    public readonly string $checksum,
  ) {
  }

  public function validate(): bool
  {
    $chars = [];
    $name = $this->name;
    $name = str_replace('-', '', $name);
    $name = str_split($name);
    foreach (array_count_values($name) as $char => $num) {
      $chars[$num][] = $char;
    }
    krsort($chars);
    $chars = array_values($chars);

    $checksum = str_split($this->checksum);
    while ($char = array_shift($checksum)) {
      if (!in_array($char, $chars[0])) return false;
      $chars[0] = array_diff($chars[0], [$char]);
      if (empty($chars[0])) unset($chars[0]);
      $chars = array_values($chars);
    }
    return true;
  }

  public function decrypt(): string
  {
    $name = str_split($this->name);
    $name = array_map(function (string $char): string {
      if ($char === '-') return ' ';
      return chr((ord($char) - ord('a') + $this->id) % 26 + ord('a'));
    }, $name);
    return implode($name);
  }
}

function input($handle): iterable
{
  while ($room = fgets($handle)) {
    $name = explode('-', trim($room, "\n]"));
    $id = array_pop($name);
    $name = implode('-', $name);
    [$id, $checksum] = explode('[', $id);
    yield new Room($name, (int) $id, $checksum);
  }
}

function part1(array $rooms): int
{
  $rooms = array_filter($rooms, fn (Room $room): bool => $room->validate());
  return array_sum(array_map(fn (Room $room): int => $room->id, $rooms));
}

function part2(array $rooms): int
{
  $rooms = array_filter($rooms, fn (Room $room): bool => $room->validate());
  $rooms = array_filter($rooms, fn (Room $room): bool => $room->decrypt() === 'northpole object storage');
  return empty($rooms) ? 0 : reset($rooms)->id;
}
