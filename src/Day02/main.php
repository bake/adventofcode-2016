<?php

namespace Bake\AdventOfCode2016\Day02;

enum Direction: string
{
  case Up = 'U';
  case Down = 'D';
  case Left = 'L';
  case Right = 'R';
}

class Point
{
  public function __construct(
    public readonly int $x,
    public readonly int $y,
  ) {
  }

  public static function zero(): self
  {
    return new self(0, 0);
  }

  public function add(Point $p): self
  {
    return new self(
      $this->x + $p->x,
      $this->y + $p->y,
    );
  }

  public function move(Direction $dir): self
  {
    return $this->add(match ($dir) {
      Direction::Up => new Point(0, -1),
      Direction::Down => new Point(0, 1),
      Direction::Left => new Point(-1, 0),
      Direction::Right => new Point(1, 0),
    });
  }

  public function restrain(self $min, self $max): self
  {
    return new self(
      max($min->x, min($max->x, $this->x)),
      max($min->y, min($max->y, $this->y)),
    );
  }

  public function __toString(): string
  {
    return "{$this->x},{$this->y}";
  }
}

/** @return iterable<Direction[]> */
function input($handle): iterable
{
  while ($instruction = fgets($handle)) {
    yield array_map(Direction::from(...), str_split(trim($instruction)));
  }
}

function part1(array $instructions): string
{
  $position = new Point(1, 1);
  $keycode = '';
  foreach ($instructions as $directions) {
    foreach ($directions as $direction) {
      $position = $position->move($direction);
      $position = $position->restrain(new Point(0, 0), new Point(2, 2));
    }
    $keycode .= $position->x + 1 + $position->y * 3;
  }
  return $keycode;
}

function part2(array $instructions): string
{
  $keypad = [
    [' ', ' ', ' ', ' ', ' ', ' ', ' '],
    [' ', ' ', ' ', '1', ' ', ' ', ' '],
    [' ', ' ', '2', '3', '4', ' ', ' '],
    [' ', '5', '6', '7', '8', '9', ' '],
    [' ', ' ', 'A', 'B', 'C', ' ', ' '],
    [' ', ' ', ' ', 'D', ' ', ' ', ' '],
    [' ', ' ', ' ', ' ', ' ', ' ', ' '],
  ];
  $keycode = '';
  $position = new Point(1, 3);
  foreach ($instructions as $directions) {
    foreach ($directions as $direction) {
      [$prev, $position] = [$position, $position->move($direction)];
      if ($keypad[$position->y][$position->x] === ' ') $position = $prev;
    }
    $keycode .= $keypad[$position->y][$position->x];
  }
  return $keycode;
}
