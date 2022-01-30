<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day23;

class Program
{
  private int $pointer = 0;
  public array $register = ['a' => 0, 'b' => 0, 'c' => 0, 'd' => 0];

  public function __construct(
    private array $instructions,
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
      'tgl' => $this->tgl(...$args),
      'mul' => $this->mul(...$args),
      'nop' => $this->nop(...$args),
    };
    return $this->pointer < count($this->instructions);
  }

  public function get(string|int $x): int
  {
    return match (is_numeric($x)) {
      true => (int) $x,
      false => $this->register[$x],
    };
  }

  public function set(string $x, int $y): void
  {
    $this->register[$x] = $y;
  }

  private function cpy(string|int $x, string $y): int
  {
    $this->set($y, $this->get($x));
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
    return $this->get($x) === 0 ? 1 : $this->get($y);
  }

  private function tgl(string|int $x): int
  {
    $x = $this->get($x);
    $pointer = $this->pointer + $x;
    if (!isset($this->instructions[$pointer])) {
      return 1;
    }
    $this->instructions[$pointer][0] = match ($this->instructions[$pointer][0]) {
      'inc' => 'dec',
      'dec' => 'inc',
      'tgl' => 'inc',
      'jnz' => 'cpy',
      'cpy' => 'jnz',
    };
    return 1;
  }

  private function mul(string|int $x, string|int $y): int
  {
    $this->register[$y] = $this->get($x) * $this->get($y);
    return 1;
  }

  private function nop(): int
  {
    return 1;
  }
}

function input($handle): Program
{
  $instructions = explode(PHP_EOL, stream_get_contents($handle));
  $instructions = array_filter($instructions);
  $instructions = array_map(fn (string $ins): array => explode(' ', $ins), $instructions);
  $instructions = array_filter($instructions, fn (array $ins): bool => reset($ins) !== '#');
  $instructions = array_values($instructions);
  return new Program($instructions);
}

function part1(Program $program): int
{
  $program->set('a', 7);
  $program->run();
  return $program->get('a');
}

// I cheated and manually modified the input.
function part2(Program $program): int
{
  $program->set('a', 12);
  $program->run();
  return $program->get('a');
}
