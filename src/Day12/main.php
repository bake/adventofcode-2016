<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2015\Day12;

class Program
{
  private int $pointer = 0;
  public array $register = ['a' => 0, 'b' => 0, 'c' => 0, 'd' => 0];

  public function __construct(
    public readonly array $instructions,
  ) {
  }

  public function run(): void
  {
    while ($this->step());
  }

  public function step(): bool
  {
    $ins = $this->instructions[$this->pointer];
    [$fn, $args] = [reset($ins), array_slice($ins, 1)];
    $this->pointer += match ($fn) {
      'cpy' => $this->cpy(...$args),
      'inc' => $this->inc(...$args),
      'dec' => $this->dec(...$args),
      'jnz' => $this->jnz(...$args),
    };
    return $this->pointer < count($this->instructions);
  }

  public function get(string $x): int
  {
    return $this->register[$x];
  }

  public function set(string $x, int $y): void
  {
    $this->register[$x] = $y;
  }

  private function cpy(string|int $x, string $y): int
  {
    $x = match (is_numeric($x)) {
      true => (int) $x,
      false => $this->get($x),
    };
    $this->set($y, $x);
    return 1;
  }

  private function inc(string $x): int
  {
    $this->set($x, $this->get($x) + 1);
    return 1;
  }

  private function dec(string $x): int
  {
    $this->set($x, $this->get($x) - 1);
    return 1;
  }

  private function jnz(string|int $x, string $y): int
  {
    $x = match (is_numeric($x)) {
      true => (int) $x,
      false => $this->get($x),
    };
    return $x === 0 ? 1 : (int) $y;
  }
}

function input($handle): Program
{
  $instructions = explode(PHP_EOL, stream_get_contents($handle));
  $instructions = array_filter($instructions);
  $instructions = array_map(fn (string $ins): array => explode(' ', $ins), $instructions);
  return new Program($instructions);
}

function part1(Program $program): int
{
  $program->run();
  return $program->get('a');
}

function part2(Program $program): int
{
  $program->set('c', 1);
  $program->run();
  return $program->get('a');
}
