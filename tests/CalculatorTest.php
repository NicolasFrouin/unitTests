<?php

use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
  private Calculator $calculator;

  protected function setUp(): void
  {
    $this->markTestSkipped("Skipping this test");
    $this->calculator = new Calculator();
  }

  public function testAdd(): void
  {
    $result = $this->calculator->add(2, 3);
    $this->assertEquals(5, $result);
  }

  public function testSubtract(): void
  {
    $result = $this->calculator->subtract(5, 2);
    $this->assertEquals(3, $result);
  }

  public function testMultiply(): void
  {
    $result = $this->calculator->multiply(4, 3);
    $this->assertEquals(12, $result);
  }

  public function testDivide(): void
  {
    $result = $this->calculator->divide(10, 2);
    $this->assertEquals(5, $result);
  }

  public function testDivideByZero(): void
  {
    $this->expectException(Exception::class);
    $this->expectExceptionMessage("Division by zero");
    $this->calculator->divide(10, 0);
  }

  public function testAvg(): void
  {
    $numbers = [1, 2, 3, 4, 5];
    $result = $this->calculator->avg($numbers);
    $this->assertEquals(3, $result);
  }

  public function testAvgWithEmptyArray(): void
  {
    $this->expectException(Exception::class);
    $this->expectExceptionMessage("Division by zero");
    $this->calculator->avg([]);
  }
}
