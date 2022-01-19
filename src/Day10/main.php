<?php

namespace Bake\AdventOfCode2016\Day10;

use SplObjectStorage;
use SplObserver;
use SplSubject;

class Input
{
  public function __construct(
    public readonly array $outputs,
    public readonly array $bots,
    public readonly array $values,
  ) {
  }
}

interface Adder
{
  public function add(int $value): void;
}

class Bot implements Adder, SplSubject
{
  public array $values = [];

  public ?Adder $low = null;
  public ?Adder $high = null;

  private SplObjectStorage $observers;

  public function __construct(
    public readonly int $id,
  ) {
    $this->observers = new SplObjectStorage;
  }

  public function attach(SplObserver $observer): void
  {
    $this->observers->attach($observer);
  }

  public function detach(SplObserver $observer): void
  {
    $this->observers->detach($observer);
  }

  public function notify(): void
  {
    foreach ($this->observers as $observer) {
      $observer->update($this);
    }
  }

  public function add(int $value): void
  {
    $this->values[] = $value;
    $this->notify();
    if (count($this->values) < 2) {
      return;
    }
    $this->low->add(min($this->values));
    $this->high->add(max($this->values));
    $this->values = [];
  }
}

class Output implements Adder
{
  public int $value = 0;

  public function __construct(
    public int $id,
  ) {
  }

  public function add(int $value): void
  {
    $this->value += $value;
  }
}

class Value
{
  public function __construct(
    public readonly int $value,
    public readonly int $dst,
  ) {
  }

  public static function from(string $string): self
  {
    return new self(...sscanf($string, 'value %d goes to bot %d'));
  }
}

function input($handle): Input
{
  $lines = explode(PHP_EOL, stream_get_contents($handle));

  $outputs = [];
  for ($i = 0; $i < 50; $i++) {
    // TODO: Generate outputs as needed.
    $outputs[$i] = new Output($i);
  }

  $bots = [];
  $instructions = array_filter($lines, fn (string $line): bool => str_starts_with($line, 'bot'));
  foreach ($instructions as $instruction) {
    [$id] = sscanf($instruction, 'bot %d');
    $bots[$id] = new Bot($id);
  }
  foreach ($instructions as $instruction) {
    [
      $id,
      $low_type, $low_id,
      $high_type, $high_id,
    ] = sscanf($instruction, 'bot %d gives low to %s %d and high to %s %d');
    $bots[$id]->low = match ($low_type) {
      'bot' => $bots[$low_id],
      'output' => $outputs[$low_id],
    };
    $bots[$id]->high = match ($high_type) {
      'bot' => $bots[$high_id],
      'output' => $outputs[$high_id],
    };
  }

  $values = array_filter($lines, fn (string $line): bool => str_starts_with($line, 'value'));
  $values = array_map(Value::from(...), $values);

  return new Input($outputs, $bots, $values);
}

/**
 * @param Output[] $outputs
 * @param Bot[] $bots
 * @param Value[] $values
 * @return int
 */
function part1(array $outputs, array $bots, array $values, int $low = 17, int $high = 61): int
{
  $observer = new class($low, $high) implements SplObserver
  {
    public Bot $bot;

    public function __construct(
      public readonly int $low,
      public readonly int $high,
    ) {
    }

    public function update(SplSubject $bot): void
    {
      if (count($bot->values) !== 2) return;
      if (min($bot->values) !== $this->low) return;
      if (max($bot->values) !== $this->high) return;
      $this->bot = $bot;
    }
  };
  foreach ($bots as $bot) {
    $bot->attach($observer);
  }

  foreach ($values as $value) {
    $bots[$value->dst]->add($value->value);
  }
  return $observer->bot->id;
}

/**
 * @param Output[] $outputs
 * @param Bot[] $bots
 * @param Value[] $values
 * @return int
 */
function part2(array $outputs, array $bots, array $values): int
{
  foreach ($values as $value) {
    $bots[$value->dst]->add($value->value);
  }
  return $outputs[0]->value * $outputs[1]->value * $outputs[2]->value;
}
