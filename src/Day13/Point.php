<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day13;

class Point
{
  public function __construct(
    public readonly int $x,
    public readonly int $y,
  ) {
  }

  public function add(self $p): self
  {
    return new self($this->x + $p->x, $this->y + $p->y);
  }

  public function __toString(): string
  {
    return "{$this->x},{$this->y}";
  }
}
