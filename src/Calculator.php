<?php

class Calculator
{
  public function add(int $a, int $b): int
  {
    return $a + $b;
  }

  public function subtract(int $a, int $b): int
  {
    return $a - $b;
  }

  public function multiply(int $a, int $b): int
  {
    return $a * $b;
  }

  public function divide(int $a, int $b): float|int
  {
    if ($b == 0) {
      throw new Exception("Division by zero");
    }
    return $a / $b;
  }

  /** @param int[] $numbers */
  public function avg(array $numbers): float|int
  {
    if (count($numbers) == 0) {
      throw new Exception("Division by zero");
    }
    return array_sum($numbers) / count($numbers);
  }
}
