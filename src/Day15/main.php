<?php

declare(strict_types=1);

namespace Bake\AdventOfCode2016\Day15;

class Disc
{
  public function __construct(
    public readonly int $id,
    public readonly int $positions,
    public readonly int $position,
  ) {
  }

  public static function from(string $string): self
  {
    return new self(...sscanf(
      string: $string,
      format: 'Disc #%d has %d positions; at time=0, it is at position %d.',
    ));
  }

  public function at(int $time): int
  {
    return ($this->id + $this->position + $time) % $this->positions;
  }
}

/** @return Disc[] */
function input($handle): array
{
  $discs = explode(PHP_EOL, stream_get_contents($handle));
  $discs = array_filter($discs);
  $discs = array_map(Disc::from(...), $discs);
  return $discs;
}

/** @param Disc[] */
function part1(array $discs): int
{
  for ($i = 0;; $i++) {
    $positions = array_map(fn (Disc $d): int => $d->at($i), $discs);
    if (array_sum($positions) === 0) break;
  }
  return $i;
}

/** @param Disc[] */
function part2(array $discs): int
{
  $discs[] = new Disc(count($discs) + 1, 11, 0);
  return part1($discs);
}
