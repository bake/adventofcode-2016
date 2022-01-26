<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day22;

class Node
{
  public function __construct(
    public readonly int $size,
    public readonly int $used,
    public readonly int $available,
  ) {
  }
}
