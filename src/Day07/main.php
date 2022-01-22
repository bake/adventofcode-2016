<?php

namespace Bake\AdventOfCode2016\Day07;

function input($handle): iterable
{
  while ($ip = fgets($handle)) {
    yield IPv7::from($ip);
  }
}

class IPv7
{
  public function __construct(
    public readonly array $even,
    public readonly array $odd,
  ) {
  }

  public static function from(string $ip): self
  {
    $parts = str_replace('[', '|', $ip);
    $parts = str_replace(']', '|', $parts);
    $parts = explode('|', $parts);
    return new self(
      array_filter(
        $parts,
        fn (int $key): bool => $key % 2 === 0,
        ARRAY_FILTER_USE_KEY,
      ),
      array_filter(
        $parts,
        fn (int $key): bool => $key % 2 === 1,
        ARRAY_FILTER_USE_KEY,
      ),
    );
  }

  public function tls(): bool
  {
    $contains_abba = function (string $str): bool {
      for ($i = 0; $i <= strlen($str) - 4; $i++) {
        if ($str[$i + 0] === $str[$i + 1]) continue;
        if ($str[$i + 0] !== $str[$i + 3]) continue;
        if ($str[$i + 1] !== $str[$i + 2]) continue;
        return true;
      }
      return false;
    };
    $even = array_filter($this->even, $contains_abba);
    $odd = array_filter($this->odd, $contains_abba);
    return !empty($even) && empty($odd);
  }

  public function ssl(): bool
  {
    $abas = function (string $str): iterable {
      $abas = [];
      for ($i = 0; $i <= strlen($str) - 3; $i++) {
        if ($str[$i + 0] === $str[$i + 1]) continue;
        if ($str[$i + 0] !== $str[$i + 2]) continue;
        $abas[] = substr($str, $i, 3);
      }
      return $abas;
    };
    $even = array_merge(...array_map($abas, $this->even));
    $odd = array_merge(...array_map($abas, $this->odd));
    foreach ($even as $aba) {
      $bab = "{$aba[1]}{$aba[0]}{$aba[1]}";
      if (in_array($bab, $odd)) return true;
    }
    return false;
  }
}

function part1(array $ips): int
{
  return count(array_filter($ips, fn (IPv7 $ip): bool => $ip->tls()));
}

function part2(array $ips): int
{
  return count(array_filter($ips, fn (IPv7 $ip): bool => $ip->ssl()));
}
