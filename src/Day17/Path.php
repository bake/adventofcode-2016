<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day17;

class Path
{
  public function __construct(
    public readonly Point $position,
    public readonly string $path,
  ) {
  }

  public function __toString(): string
  {
    return $this->path;
  }
}
