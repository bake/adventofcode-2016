<?php

namespace Bake\AdventOfCode2016\Day01;

enum Direction: string
{
  case Left = 'L';
  case Right = 'R';

  public function int(): int
  {
    return match ($this) {
      Direction::Left => -1,
      Direction::Right => 1,
    };
  }
}

class Instruction
{
  public function __construct(
    public readonly Direction $direction,
    public readonly int $distance,
  ) {
  }

  public static function from(string $string): self
  {
    return new self(Direction::from($string[0]), substr($string, 1));
  }
}

class Point
{
  public function __construct(
    public readonly int $x,
    public readonly int $y,
  ) {
  }

  public function add(Point $p): self
  {
    return new self(
      $this->x + $p->x,
      $this->y + $p->y,
    );
  }

  public function __toString(): string
  {
    return "{$this->x},{$this->y}";
  }
}

class Entity
{
  public function __construct(
    public readonly Point $position,
    public readonly int $direction,
  ) {
  }

  public static function zero(): self
  {
    return new self(
      new Point(0, 0),
      0,
    );
  }

  public function instruction(Instruction $instruction): self
  {
    $entity = $this;
    $entity = $entity->rotate($instruction->direction);
    $entity = $entity->move($instruction->distance);
    return $entity;
  }

  public function rotate(Direction $direction): self
  {
    return new self(
      $this->position,
      ($this->direction + $direction->int() + 4) % 4,
    );
  }

  public function move(int $distance): self
  {
    return new self(
      $this->position->add(new Point(
        match ($this->direction) {
          1 => $distance,
          3 => -$distance,
          default => 0,
        },
        match ($this->direction) {
          0 => -$distance,
          2 => $distance,
          default => 0,
        },
      )),
      $this->direction,
    );
  }
}

function input($handle): array
{
  $instructions = explode(',', trim(stream_get_contents($handle)));
  $instructions = array_map(trim(...), $instructions);
  $instructions = array_map(Instruction::from(...), $instructions);
  return $instructions;
}

function part1(array $instructions): int
{
  $entity = array_reduce(
    $instructions,
    fn (Entity $e, Instruction $i): Entity => $e->instruction($i),
    Entity::zero(),
  );
  return abs($entity->position->x) + abs($entity->position->y);
}

function part2(array $instructions): int
{
  $entity = Entity::zero();
  $visited = [];
  foreach ($instructions as $instruction) {
    $prev = $entity->position;
    $entity = $entity->instruction($instruction);
    $curr = $entity->position;
    while ($curr->x !== $prev->x || $curr->y !== $prev->y) {
      $prev = $prev->add(new Point(
        $curr->x <=> $prev->x,
        $curr->y <=> $prev->y,
      ));
      if (isset($visited["{$prev}"])) return $visited["{$prev}"];
      $visited["{$prev}"] = abs($prev->x) + abs($prev->y);
    }
  }
  return 0;
}
