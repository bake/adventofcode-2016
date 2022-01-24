<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day20;

class Range
{
  public function __construct(
    public readonly int $min,
    public readonly int $max,
  ) {
  }

  public static function from(string $string): self
  {
    $values = explode('-', $string, 2);
    $values = array_map(intval(...), $values);
    return new self(...$values);
  }

  public function __toString(): string
  {
    return "{$this->min}-{$this->max}";
  }
}
